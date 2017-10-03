<?php

class StarsController extends BaseController {

	public function getIndex()
	{
		$type = Input::get('type')  ;
		$atri_1 = Input::get('atri_1')  ;
		$atri_2 = Input::get('atri_2')  ;
		$fitness = Input::get('fitness')  ;
		$form = Input::get('form')  ;
		$xp = Input::get('xp')  ;
		$type2 = Input::get('type2') !== NULL ? Input::get('type2'):0 ;

		if($type === NULL || $atri_1 === NULL || $atri_2 === NULL || $fitness=== NULL){
			$stars['isset'] = FALSE ;
			return View::make('stars', array('stars' => $stars ,'title' => 'Star Calculator'));
		}

		$validator = Validator::make(
			array(
				'type' => $type,
				'atri_1' => $atri_1,
				'atri_2' => $atri_2,
				'fitness' => $fitness,
				'form' => $form,
				'xp' => $xp,
				'type2' => $type2, 
				),
			array(
				'type' => 'in:batsman,bowler',
				'atri_1' => 'integer|min:0|max:20',
				'atri_2' => 'integer|min:0|max:20',
				'fitness' => 'integer|min:1|max:6',
				'form' => 'integer|min:1|max:6',
				'xp' => 'integer|min:0|max:20',
				'type2' => 'in:0,spin,seam',
				)
			);

		if ($validator->fails())
    	{
    		
   		    return Redirect::to('/index')->withErrors($validator);
    	}

    	$form_penlty = array(
    				'0' => (29  / 100), 
					'1' => (20  / 100), 
					'2' => (15  / 100), 
					'3' => (9  / 100), 
					'4' => (3  / 100), 
					'5' => (0  / 100), 
    				);

    	$xp_penlty = array(
    				'0' => (10  / 100), 
					'1' => (9  / 100), 
					'2' => (8  / 100), 
					'3' => (7  / 100), 
					'4' => (6  / 100), 
					'5' => (5  / 100), 
					'6' => (4  / 100), 
					'7' => (3  / 100), 
					'8' => (2  / 100), 
					'9' => (1  / 100), 
					'10' => (0  / 100), 
					'11' => (0  / 100), 
					'12' => (0  / 100), 
					'13' => (0  / 100), 
					'14' => (0  / 100), 
					'15' => (0  / 100), 
					'16' => (0  / 100), 
					'17' => (0  / 100), 
					'18' => (0  / 100), 
					'19' => (0  / 100), 
					'20' => (0  / 100), 
    				);

		$penlty = array(
			'spin' => array(
						'0' => (12  / 100), 
						'1' => (10  / 100), 
						'2' => (8  / 100), 
						'3' => (5  / 100), 
						'4' => (2  / 100), 
						'5' => (0  / 100),
						),
			'seam' => array(
						'0' => (20  / 100), 
						'1' => (14  / 100), 
						'2' => (10  / 100), 
						'3' => (8  / 100), 
						'4' => (4  / 100), 
						'5' => (0  / 100), 
						),	
			'bat' => array(
						'0' => (21  / 100), 
						'1' => (18  / 100), 
						'2' => (15  / 100), 
						'3' => (10  / 100), 
						'4' => (5  / 100), 
						'5' => (0  / 100),
						),		
			);

		if($type == "bowler"){

			$stars = $atri_1 / 2.3 ;
			$stars = $stars + $atri_2 ;

			if($type2 == "spin"){

				$stars = $stars - ($stars * $penlty['spin'][($fitness - 1)]) - ($stars * $form_penlty[($form - 1)]) - ($stars * $xp_penlty[$xp]);
				
			} elseif ($type2 == "seam") {

				$stars = $stars - ($stars * $penlty['seam'][($fitness - 1)]) - ($stars * $form_penlty[($form - 1)]) - ($stars * $xp_penlty[$xp]) ;

			}
	
		} elseif ($type == "batsman") {
	
			$stars = (($atri_1 + $atri_2) / 2) - 1 ;
			$stars = $stars - ($stars * $penlty['bat'][($fitness - 1)]) - ($stars * $form_penlty[($form - 1)]) - ($stars * $xp_penlty[$xp]);
		}

		$stars1 = $stars;
		$stars = array();
		$stars['sporting'] =  abs(round($stars1 * 2) / 2);
		$stars['isset'] = TRUE;
		if ($type == "batsman") {
			
			$stars['crumbling'] = abs(round($stars['sporting'] * 2)  / 2) ;
			$stars['green'] = abs(round($stars['sporting'] * 2) / 2) ;
			$stars['flat'] = abs(round(($stars['sporting'] + ((10 / 100) * $stars['sporting']) ) * 2) / 2);

		} else {

			if ($type2 == "seam") {

				$stars['green'] = abs(round(($stars['sporting'] + ((10 / 100) * $stars['sporting']) ) * 2) / 2) ;
				$stars['crumbling'] = abs(round(($stars['sporting'] - ((5 / 100) * $stars['sporting']) ) * 2) / 2);
				
			} else {

				$stars['crumbling'] = abs(round(($stars['sporting'] + ((10 / 100) * $stars['sporting']) ) * 2) / 2) ;
				$stars['green'] = abs(round(($stars['sporting'] - ((5 / 100) * $stars['sporting']) ) * 2) / 2) ;
			}
			
			$stars['flat'] = abs(round(($stars['sporting'] - ((5 / 100) * $stars['sporting']) ) * 2) / 2);
		}

		return View::make('stars', array('stars' => $stars ,'title' => 'Star Calculator'));
	}


}