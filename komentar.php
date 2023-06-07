<?php
// Update the details below with your MySQL details
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'portal';
try {
    $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
} catch (PDOException $exception) {
    // If there is an error with the connection, stop the script and display the error
    exit('Failed to connect to database!');

}



// Below function will convert datetime to time elapsed string
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
// This function will populate the comments and comments replies using a loop
function show_comments($comments, $parent_id = -1) {
    $html = '';
    if ($parent_id != -1) {
        // If the comments are replies sort them by the "submit_date" column
        array_multisort(array_column($comments, 'submit_date'), SORT_ASC, $comments);
    }
    // Iterate the comments using the foreach loop
    foreach ($comments as $comment) {
        if ($comment['parent_id'] == $parent_id) {
            // Add the comment to the $html variable
            $html .= '
            <div class="comment" style="margin-left:20px; ">
                <div>   
                <img class="rounded-circle mr-2" src="login/news/user.png" width="25" height="25" alt="">
                    <h3 style="text-transform:uppercase;" class="name">' . htmlspecialchars($comment['name'], ENT_QUOTES) . '</h3>
                    <span style="font-size:10px;" class="date">' . time_elapsed_string($comment['submit_date']) . '</span>
                </div>
                <p  style="margin-left:10px;"class="content">           
                 <input   style="border-color:#55a1ff; border-radius:10px; background-color:#edeff4;"
                 value="'. nl2br(htmlspecialchars($comment['content'], ENT_QUOTES)) .' "readonly/> </p> 
               
                <a class="reply_comment_btn" style="color:#55a1ff;" href="#" data-comment-id="' . $comment['id'] . '">
                <button style="border-radius:20px; font-size:10px; margin-left:20px; background-color:#55a1ff;"  type="submit" class="btn btn-info">Odgovori</button></a>
                ' . show_write_comment_form($comment['id']) . '
                <div class="replies">
                ' . show_comments($comments, $comment['id']) . '
                </div>
            </div>
            ';
        }
    }
    return $html;
}
// This function is the template for the write comment form
function show_write_comment_form($parent_id = -1) {
    $x=rand(9999,1000);
    $html = '
    <div style="margin-left:10px;" class="write_comment" data-comment-id="' . $parent_id . '">
        <form>
            <input name="parent_id" type="hidden" value="' . $parent_id . '">
            <input name="name" type="text" placeholder="Ime *" required>
            <textarea name="content" placeholder="Komentar *" required></textarea>
            <input type="hidden" name="captcha-rand" value="' . $x . '" />
            Unesite kod za provjeru: <b style="background-color:yellow;">' . $x . ' </b>
            <input type="text" name="captcha"> 

            <button type="submit" style="background-color:#55a1ff; margin-left:10px;"  onClick="window.location.reload()">Objavi</button>
        </form>
    </div>';
    return $html;
}


// Page ID needs to exist, this is used to determine which comments are for which page
if (isset($_GET['page_id'])) {
    // Check if the submitted form variables exist
    if (isset($_POST['name'], $_POST['content'])) {
        $y = $_REQUEST['captcha'];
        $z = $_REQUEST['captcha-rand'];
        // POST variables exist, insert a new comment into the MySQL comments table (user submitted form)
        if ($y == $z) {
            $stmt = $pdo->prepare('INSERT INTO comments (page_id, parent_id, name, content, submit_date, visible) VALUES (?,?,?,?,NOW(),1)');
            $stmt->execute([$_GET['page_id'], $_POST['parent_id'], $_POST['name'], $_POST['content']]);
            echo ('Vaš komentar je objavljen!');
        }
        else if ($y != $z) {
            header("Location: index.php");
        }
    }
    // Get all comments by the Page ID ordered by the submit date
    $stmt = $pdo->prepare('SELECT * FROM comments WHERE page_id = ? and visible=1 ORDER BY submit_date DESC');
    $stmt->execute([ $_GET['page_id'] ]);
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Get the total number of comments
    $stmt = $pdo->prepare('SELECT COUNT(*) AS total_comments FROM comments WHERE page_id = ? and visible=1');
    $stmt->execute([ $_GET['page_id'] ]);
    $comments_info = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    exit('No page ID specified!');
}
?><div class="comment_header">
<span style="margin-left:10px;" class="total"><?=$comments_info['total_comments']?> komentara</span>
<a href="#" class="write_comment_btn" data-comment-id="-1" style="background-color:#55a1ff; margin-right:10px;">Napišite komentar</a>
</div>

<?=show_write_comment_form()?>

<?=show_comments($comments)?>