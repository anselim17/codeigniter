<?php
@session_start();
function add_current($current_page, $page){
	if($current_page==$page){
		echo "class=current ";
	}
}

$base_name = basename($_SERVER['REQUEST_URI'], ".php");
$page = ($base_name == 'index' || strpos(basename($_SERVER['REQUEST_URI']), ".php") === false) ? 'Homepage' : ucwords(str_replace('-',' ',$base_name));
$mkeywords = "Medicka, Medical Supply, Anesthesia & Intensive Care, Beds & Stretchers, Cardiology & Vascular, Consumables & Supplies, Cosmetics& Lasers, Dentistry & Orthodontics, EMR & Rescue, ENT & Facial, Endoscopy & Related, Exam Room & Diagnostics, Furniture & Furnishing, General Medicine, Home Care, Imaging & Ultrasound, Pathology & Lab, Monitors & Monitoring, Neonates & Pediatrics, Neurology & Psychiatry, Ophthalmology & Optometry, Orthopedic & Prosthetics, Physical Therapy & Rehab, Pumps, Pulmonology & Sleep, Radiation & Chemotherapy, Sterilization &Sterile Processing, Surgery & Operating Room, Test Equipment & Tools, Ultrasound Transducers, Urology & OB/GYN, Veterinary Bioscience, Vintage, What's New, Xplicit Fitness, Yoga & Meditation, Zap it";
$mdescriptions = "Medicka - Medical Equipment and Supplies Online Shop - Apple Valley, Minnesota";
$compname = 'Medicka';
 if($page == 'Homepage'):
	$dtitle = $compname. 'Medical Equipment and Supplies Online Shop - Apple Valley, Minnesota';
 else:
	$dtitle = $compname. ' - Medical Equipment and Supplies Online Shop - Apple Valley, Minnesota - '.$page;
 endif;

?>