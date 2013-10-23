<?
require_once($_SERVER['DOCUMENT_ROOT'].'/openinviter/saveInvitesClass.php');
$invite=new saveInvite();
if(isset($_GET['email'])){
	$registrosInv=$invite->delProfile("email='".addslashes($_GET['email'])."'");
}
?>
<script type="text/javascript">
	window.location.href='http://www.soccermash.com';
</script>