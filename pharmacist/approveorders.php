<?php 
	require_once '../core/init.php';
	include "../classes/db.php";
?>
<html>
	<head>
		<title>Good Life</title>
		<style>
			table, th, td {
			   border: 1px solid black;
			}
			table {
			    border-collapse: collapse;
			}
			th, td {
			    padding: 15px;
			    text-align: left;
			}
			tr:hover {
				background-color: #f5f5f5;
			}
		</style>
	</head>
	<body>
		<h1>Orders</h1>
		<?php
		$db=DB::getInstance();
		/* approve orders */
		if (isset($_GET['id'])){
			$db->update('order_medicine', $_GET['id'], array('approved'=>'1') );
			header("Location:approveorders.php");
		}

		/* get orders */
		
		$appD=$db->get('order_medicine', array('approved', '=', '0'));
		$appD=$appD->results();
		if (count($appD)>0){ ?>
		<table>
		<tr>
			<td>Order ID</td>
			<td>User ID</td>
			<td>Note</td>
			<td>Prescription</td>
			<td>Action</td>
		</tr>
		<?php foreach ($appD as $app) { ?>
      	<tr>
      		<td> <?php echo $app->id; ?> </td>
      		<td> <?php echo $app->user_id; ?> </td>
      		<td> <?php echo $app->note; ?> </td>
      		<td> <?php echo "<img src=$app->prescription width='50%' height='50%'>"; ?> </td>
      		<td> <a href="approveorders.php?id=<?php echo $app->id; ?>"><button>Approve</button></a> </td>
    	</tr>
      	<?php 
  		}
  		} else {
  			echo "<h2 style='color:red;'>Not available</h2>";
  		}  
      	?>
		</table>
	</body>
</html>
