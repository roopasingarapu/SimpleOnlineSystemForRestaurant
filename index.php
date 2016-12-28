<?php 
$db = mysql_connect('localhost', 'root', ''); 

mysql_select_db('restaurant', $db);
$result = array();
?>
<!doctype html>
<html>
<head>
    <title>Roopa</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="screen.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>

</head>
<body>
    <header>
        <h1 class="logo"><center>Roopa Restaurant</center></h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="rules.php">Instructions</a></li>
                <li><a href="contact.php">Contact us</a></li>
            </ul>
        </nav>
        <div class="clear">
		</div>
    </header>
    <div id="container">
<?php
	echo '<form action="?p=search" method="post">';
	echo '<label for="searchitem">Search </label><input type="text" name="searchitem" />&nbsp';
	echo '<input type="submit" value="Search" />';
	echo '</form>';
		echo '<br>';
	echo '<form action="?p=index" method="post">';
	echo '<input type="submit" value="Refresh" />';
	echo '</form>';	
?>	  
	  <hr>
	  <br>
<?php
	echo '<form action="?p=add" method="post">';
	echo '<h2>Add to the menu</h2>';
	echo '<label for="itemname">Enter the name of item </label><input type="text" name="itemname" />&nbsp';
	echo '<br>';
	echo '<label for="spice">Enter the spice of item</label><input type="text" name="spice" />&nbsp';
	echo '<br>';
	echo '<label for="qty">Enter the quantity of item</label><input type="text" name="qty" />&nbsp';
	echo '<br>';
	echo '<label for="price">Enter the price of item </label><input type="text" name="price" />&nbsp';
	echo '<br>';
	echo '<input type="submit" value="Add" />';
	echo '</form>';
	echo '<br>';
	echo '<hr>';
	echo '<form action="?p=update" method="post">';
	echo '<h2>Update the menu</h2>';
	echo '<label for="id">Enter the RowId which you want to Update </label><input type="text" name="id" />&nbsp';
	echo '<br>';
	echo '<h3>Enter the New details </h3>';
	echo '<label for="itemname">Enter the name of item </label><input type="text" name="itemname" />&nbsp&nbsp&nbsp';
	echo '<label for="spice">Enter the spice of item</label><input type="text" name="spice" />&nbsp';
	echo '<br>';
	echo '<label for="qty">Enter the quantity </label><input type="text" name="qty" />&nbsp&nbsp&nbsp';
	echo '<label for="price">Enter the price of item </label><input type="text" name="price" />&nbsp';
	echo '<br>';
	echo '<input type="submit" value="Update" />';
	echo '</form>';
	echo '<br>';
	echo '<hr>';
	echo '<form action="?p=delete" method="post">';
	echo '<h2>Delete from menu</h2>';
	echo '<label for="deleteitem">Enter the name of item you wish to delete </label><input type="text" name="deleteitem" />&nbsp';
	echo '<br>';
	echo '<input type="submit" value="Delete" />';
	echo '</form>';
	echo '<br>';
	echo '<hr>';
	echo '<br>';

function delete($item) {
	$result_delete = mysql_query(" DELETE FROM menu WHERE name='$item' ");
	index();
}

function update($id, $item, $spice, $qty, $price) {
	$result_update = mysql_query(" UPDATE menu SET name='$item', spice='$spice', qty='$qty', price='$price' WHERE id='$id' ");
	index();
}

function add($item, $spice, $qty, $price) {
	$result_add = mysql_query(" INSERT INTO menu (name, spice, qty, price) VALUES ('$item', '$spice', '$qty', '$price')");
	index();
}

function search($item) {
	$result_search = mysql_query(" SELECT * FROM menu WHERE name='$item'");
	//var_dump($result_search);
	test($result_search);
}

$action = @$_GET['p'];

switch ($action) {
	
	case 'delete':	
		$item = @$_POST['deleteitem'];
		delete($item);
		break;
	
	case 'update':
		$id = @$_POST['id'];
		$item = @$_POST['itemname'];
		$spice = @$_POST['spice'];
		$qty = @$_POST['qty'];
		$price = @$_POST['price'];
		update($id,$item,$spice,$qty,$price);
		break;
		
	case 'add':
		$item = @$_POST['itemname'];
		$spice = @$_POST['spice'];
		$qty = @$_POST['qty'];
		$price = @$_POST['price'];
		add($item,$spice,$qty,$price);
		break;
		
	case 'search':
		$item = @$_POST['searchitem'];
		search($item);
		break;
		
	default:
		index();
		}
		
function index() {
	$result = mysql_query("SELECT * FROM menu order by name");
echo '<h1>Indian Menu</h1>';	
	echo "<table width='900' border='1'>
    <tr>
    <th>Id</th>
    <th>Name</th>
    <th>Spice</th>
    <th>Qty</th>
    <th>Price($)</th>
    </tr>";
	
	while ($row = mysql_fetch_array($result)) {
		echo "<td><center>" . $row['id'] . "</td>";
		echo "<td><font color=blue>" . $row['name'] . "</td>";
		echo "<td><center>" . $row['spice'] . "</td>";
		echo "<td><center>" . $row['qty'] . "</td>";
		echo "<td><center>" . $row['price'] . "</td>";
		echo "</tr>";
}
	echo "</table>";	
	}

function test($result) {
	//$result = mysql_query("SELECT * FROM menu order by name");	
	echo "<table width='900' border='1'>
    <tr>
    <th>Id</th>
    <th>Name</th>
    <th>Spice</th>
    <th>Qty</th>
    <th>Price($)</th>
    </tr>";
	
	while ($row = mysql_fetch_array($result)) {
		echo "<td><center>" . $row['id'] . "</td>";
		echo "<td><font color=blue>" . $row['name'] . "</td>";
		echo "<td><center>" . $row['spice'] . "</td>";
		echo "<td><center>" . $row['qty'] . "</td>";
		echo "<td><center>" . $row['price'] . "</td>";
		echo "</tr>";
}
	echo "</table>";	
	}	
	
?>  
    </div>
    <footer>
        &copy; Roopa 2014. All rights reserved.
    </footer>
</body>
</html>
