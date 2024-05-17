<?php
$sid=$_SESSION['stdid'];
$sql="SELECT 
tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetail 
s.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine from tblissuedbookdetails 
join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on 
tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by 
tblissuedbookdetails.id desc";
$query = $dbh -> prepare($sql);
$query-> bindParam(':sid', $sid, PDO::PARAM_STR);$query->execute();
34
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
?>

