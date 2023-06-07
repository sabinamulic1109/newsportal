<?php  
include 'config.php';
$search = $_GET['search'];
$search = str_ireplace('.',' ',$search); 
$type = $_GET['type'];
//echo $type;
$rezultat = array();
switch($type){
	case 'news':
		$sql = "SELECT * FROM novosti WHERE UPPER(naslov) LIKE UPPER('%$search%') or UPPER(podnaslov) LIKE UPPER('%$search%') or UPPER(tekst) LIKE UPPER('%$search%')"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;
		
	case 'oglasi':
		$sql = "SELECT * FROM oglasi WHERE UPPER(naslov) LIKE UPPER('%$search%') or UPPER(link) LIKE UPPER('%$search%')"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;
		
	case 'products':
		$sql = "SELECT * FROM shop_artikli WHERE UPPER(naziv) LIKE UPPER('%$search%') or UPPER(opis) LIKE UPPER('%$search%')"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;	

	case 'ordersAuth':
		$sql = "SELECT order_id, order_number, order_amount,order_authorizenet_dateTime,order_status,order_customerid, customers.customer_full_name as fullName, customers.customer_phone as phone, customers.customer_email as email from orders INNER JOIN customers ON orders.order_customerid=customers.customer_id WHERE UPPER(customers.customer_email) LIKE UPPER('%$search%') or UPPER(customers.customer_phone) LIKE UPPER('%$search%') or UPPER(customers.customer_full_name) LIKE UPPER('%$search%') or UPPER(order_number) LIKE UPPER('%$search%')"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;	
		
	case 'customerPP':
		$sql = "SELECT * FROM  customersPP WHERE UPPER(customer_full_name) LIKE UPPER('%$search%') or UPPER(customer_email) LIKE UPPER('%$search%') or UPPER(customer_phone) LIKE UPPER('%$search%') or UPPER(ship_customer_city) LIKE UPPER('%$search%') or UPPER(ship_customer_stateprovince) LIKE UPPER('%$search%') or UPPER(customer_country) LIKE UPPER('%$search%')"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;		
		
	case 'customerAuth':
		$sql = "SELECT * FROM customers WHERE UPPER(customer_full_name) LIKE UPPER('%$search%') or UPPER(customer_email) LIKE UPPER('%$search%') or UPPER(customer_phone) LIKE UPPER('%$search%') or UPPER(customer_city) LIKE UPPER('%$search%') or UPPER(customer_stateprovince) LIKE UPPER('%$search%') or UPPER(customer_country) LIKE UPPER('%$search%')"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;

	case 'productGroup':
		$sql = "SELECT * FROM shop_group WHERE UPPER(naziv) LIKE UPPER('%$search%')"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}	
		break;			
		
		
	case 'file':
		$sql = "SELECT * FROM dokumenti WHERE UPPER(naslov) LIKE UPPER('%$search%')"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;
	case 'reservations':
		$sql = "SELECT * FROM reservation WHERE UPPER(dog) LIKE UPPER('%$search%') or UPPER(name) LIKE UPPER('%$search%') or UPPER(email) LIKE UPPER('%$search%')"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;
	case 'testimonials':
		$sql = "SELECT * FROM testimonials WHERE UPPER(authoremail) LIKE UPPER('%$search%') or UPPER(concat(authorname,' ',authorlastname)) LIKE UPPER('%$search%') or UPPER(testimonial) LIKE UPPER('%$search%')"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;
	case 'content':
		$sql = "SELECT * FROM tekst WHERE UPPER(naslov) LIKE UPPER('%$search%') or UPPER(podnaslov) LIKE UPPER('%$search%')"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;
	case 'menu':
		$sql = "SELECT * FROM grupe WHERE UPPER(naziv) LIKE UPPER('%$search%')"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;
	case 'submenu':
		$grupa = $_GET['grupa'];
		$sql = "SELECT * FROM podgrupe WHERE UPPER(naziv) LIKE UPPER('%$search%') and grupa = $grupa"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;
	case 'gallery':
		$sql = "SELECT * FROM galerija WHERE UPPER(naziv) LIKE UPPER('%$search%')"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;
	case 'questions':
		$sql = "SELECT * FROM tblfaq WHERE UPPER(question) LIKE UPPER('%$search%')"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;
	case 'messages':
		$sql = "SELECT id, isRead, name,email,date,SUBSTRING(message, 1, 50) as message from poruke WHERE UPPER(name) LIKE UPPER('%$search%') or UPPER(email) LIKE UPPER('%$search%') order by id desc"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;
	case 'users':
		$sql = "SELECT id, user FROM `admin` WHERE UPPER(user) LIKE UPPER('%$search%') and id!=2 order by id desc"; 
		$result = mysqli_query ($con,$sql); 
		while($row = mysqli_fetch_array($result)){
			$rezultat[] = $row;
		}
		break;			
	default:
		break;
}

	echo json_encode($rezultat);

?>