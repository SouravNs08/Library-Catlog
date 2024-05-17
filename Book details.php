Book details  
<?php
$sid=$_SESSION['stdid'];
$sql="SELECT 
tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetail 
s.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine from tblissuedbookdetails 
join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on 
tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by 
tblissuedbookdetails.id desc";
$query = $dbh -> prepare($sql);$query-> bindParam(':sid', $sid, PDO::PARAM_STR);
37
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<tr class="odd gradeX">
<td class="center"><?php echo htmlentities($cnt);?></td>
<td class="center"><?php echo 
htmlentities($result->BookName);?></td>
<td class="center"><?php echo 
htmlentities($result->ISBNNumber);?></td>
<td class="center"><?php echo 
htmlentities($result->IssuesDate);?></td>
<td class="center"><?php if($result->ReturnDate=="")
{?>
<span style="color:red">
<?php echo htmlentities("Not Return Yet"); ?>
</span>
<?php } else {
echo htmlentities($result->ReturnDate);
}
?></td>
<td class="center"><?php echo htmlentities($result->fine);?></td>
</tr>
<?php $cnt=$cnt+1;}} ?>
</tbody>
</table>
</div>
</div>
</div>
<!--End Advanced Tables -->
</div>
</div>
</div>
</div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
<!-- FOOTER SECTION END-->
<!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME -->
<!-- CORE JQUERY --><script src="assets/js/jquery-1.10.2.js"></script>
38
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- DATATABLE SCRIPTS -->
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>

LOGOUT.PHP
<?php 
session_start();
$_SESSION = array();
if (ini_get("session.use_cookies")) {
$params = session_get_cookie_params(); 
setcookie(session_name(), '', time() - 60*60,
$params["path"], $params["domain"],
$params["secure"], $params["httponly"]
);
}
unset($_SESSION['login']); 
session_destroy(); // destroy session 
header("location:index.php");
?