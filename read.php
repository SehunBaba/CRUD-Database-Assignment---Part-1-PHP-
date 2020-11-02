<?php
include 'functions.php';

//Connect to Database
$pdo = pdo_connect_mysql();



// Retrive the page with a GET request (URL param: page), if non exists default the page to 1

$page =  isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

//Number of records to show on each page
$records_per_page = 5;

//Once again we include the functions file, but this time we connect to our MySQL database by executing the function: pdo_connect_mysql, 
//if the connection is successful we can use the $pdo variable to execute queries.
/* We also create 2 more variables, the $page variable will determine the page that the user is currently on, the $records_per_page will be used to limit the number of records to display on each page.
 For example, if we limit the number of records to 5 and we have 10 records in our table, then there will only be 2 pages and 5 records on each page, 
 the user will be able to navigate between pages.
 */

//Prepare the SQL statement and get records from our table, LIMIT will determine the page
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM acco ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// Fetch the records so we can display them in our template.
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);


/* 
The above code will select records from the table, 
this will be determined by the current page the user is on, the records will be ordered by the id column, we can easily change the order by column if we wanted to, for example, if we change it to created then it will sort the records by the create date instead.
We're also using a prepared statement for the above query, 
this will make sure our query is secure (escapes user input data). */

//Get the total number of records, this is so we can determine whether there should be a next and previous button
$num_accounts =  $pdo->query('SELECT COUNT(*) FROM accounts')->fetchColumn();

//The above SQL query will get the total number of records in the contacts table,
//we don't need to use a prepared statement here because the query doesn't include user input variables.

?>

<!--    HTML for displaying the records  -->

<?=template_header('Read')?>

<div class="content read">
	<h2>Read Prescription</h2>
	<a href="create.php" class="create-prescription">Create Prescription </a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Email</td>
                <td>Medication</td>
                <td>Doctor</td>
                <td>Time Proscribed</td>
                <td>Pickup Date</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accounts as $account): ?>
            <tr>
                <td><?=$account['id']?></td>
                <td><?=$account['username']?></td>
                <td><?=$account['email']?></td>
                <td><?=$account['medication']?></td>
                <td><?=$account['doctor']?></td>
                <td><?=$account['time_created']?></td>
                <td><?=$account['pickup_date']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$account['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$account['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_accounts): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>

<!-- This is the template for the read page, the code iterates the contacts and adds them to the HTML table, we'll be able to read the records in a table format when we navigate to the read page.
Pagination is added so we can navigate between pages on the read page (page 1, page 2, etc) -->