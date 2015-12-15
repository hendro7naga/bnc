<?php
//untuk kumpulan fungsinya.

/*function aman($q)
{
	return mysql_real_escape_string($q); //say goodbye to old sql style... :D
}*/
function aman($conn, $q) {
    return mysqli_real_escape_string($conn, $q);
}

function bnArray($q)
{
	return mysql_fetch_array($q);
}

function bnObject($q)
{
	return mysql_fetch_object($q);
}

function bnRow($q)
{
	return mysql_num_rows($q);
}

function bnQuery($q)
{
	return mysql_query($q);
}

// mulai fungsi halaman depan

// akhir fungsi halaman depan


// mulai fungsi halaman admin

// akhir fungsi halaman admin
?>