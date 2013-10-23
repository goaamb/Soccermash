<? 		
		private function selectTable(){
			if($profileId<7){
				$tableProfile='ax_player';
			}elseif($profileId<13){
				$tableProfile='ax_coach';
			}elseif($profileId<16){
				$tableProfile='ax_agent';
			}elseif($profileId==16){
				$tableProfile='ax_scout';
			}elseif($profileId==17){
				$tableProfile='ax_lawyer';
			}elseif($profileId<20){
				$tableProfile='ax_manager';
			}elseif($profileId<23){
				$tableProfile='ax_medic';
			}elseif($profileId==23){
				$tableProfile='ax_fan';
			}elseif($profileId==24){
				$tableProfile='ax_journalist';
			}elseif($profileId==25){
				$tableProfile='ax_selection';
			}elseif($profileId==26){
				$tableProfile='ax_club';
			}elseif($profileId==27){
				$tableProfile='ax_company';
			}
		
		}
		
?>		