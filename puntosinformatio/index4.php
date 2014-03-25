<?php $ruta = 'http://127.0.0.1/puntosinformatio/';  ?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Resultados Georeferenciados</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>css/bootstrap.spacelab.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>css/bootstrap-responsive.min.css">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
	<link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>css/maps.css">

	<script type="text/javascript" src="<?php echo $ruta ?>js/general/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<script type="text/javascript" src="http://geoxml3.googlecode.com/svn/branches/polys/geoxml3.js"></script>


	<script type="text/javascript">
		
		google.load('visualization', '1', {'packages':['corechart', 'table', 'geomap']});

		var kmlArray = [];
		var maploaded = false;
		var layer;
		var capaKml;
		var table_dpto = '1GpIA0mBHMTame6QFenQeQCazLW4NiLciy3lfLvSZ';

		function checkGoogleMap() {
			
			//specify the target element for our messages
			var msg = document.getElementById('msg');

			if (maploaded == false) {
				//if we dont have a fully loaded map - show the message
				msg.innerHTML = 'Cargando puntos...';
				$("#msg").slideDown("fast");

			} else {
				//otherwise, show 'loaded' message then hide the message after a second
				msg.innerHTML = 'Puntos cargados.'
				$("#msg").slideUp("slow");
			} 
		}

		function initialize() {
			var myOptions = {
				zoom: 6,
				center: new google.maps.LatLng(-9.817329,-69.920655),
				// mapTypeId: google.maps.MapTypeId.SATELLITE,
				mapTypeId: google.maps.MapTypeId.ROADMAP
				// zoomControl: true,
				// zoomControlOptions: {
				// 	style: google.maps.ZoomControlStyle.LARGE,
				// 	position: google.maps.ControlPosition.RIGHT_CENTER
				// },
				// streetViewControl: true,
				// streetViewControlOptions:{
				// 	position: google.maps.ControlPosition.RIGHT_CENTER
				// },
				// panControl: false,
				// panControlOptions: {
				// 	position: google.maps.ControlPosition.RIGHT_CENTER
				// },
				// scaleControl: false,
				// scaleControlOptions: {
				// 	position: google.maps.ControlPosition.RIGHT_CENTER
				// },
				// mapTypeControl: true,
				// mapTypeControlOptions: {
				// 	style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
				// 	position: google.maps.ControlPosition.RIGHT_CENTER
				// }
			}

			map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

			// <?php $urlKml = 'http://webinei.inei.gob.pe/cie/2013/web/'; ?>
			// var kmlPeru = '<?php echo $urlKml.'kml/peru.kml'; ?>';
			// var kmlPeru = 'http://www.uxglass.com/kml/demo.kml';
			// http://www.uxglass.com/lenguas/departamento/


			// kmlPeruLayer = new google.maps.KmlLayer ( kmlPeru, {preserveViewport:true});
			// kmlArray.push({cd:'0', nomkml:kmlPeruLayer, lat:-9.817329, lng:-69.920655, zm:6});
			// // kmlArray[0].nomkml.setMap(map);

			// // KML MAPS LAYERS
			// var kmlAmazonas = '<?php echo $urlKml.'kml/amazonas.kml'; ?>';
			// kmlAmazonasLayer = new google.maps.KmlLayer ( kmlAmazonas, {preserveViewport:true});
			// kmlArray.push({cd:'01', nomkml:kmlAmazonasLayer, lat:-5.06036873877975, lng:-78.056629714081, zm:8});

			// var kmlAncash = '<?php echo $urlKml.'kml/ancash.kml'; ?>';
			// kmlAncashLayer = new google.maps.KmlLayer ( kmlAncash, {preserveViewport:true});  
			// kmlArray.push({cd:'02', nomkml:kmlAncashLayer, lat:-9.40575405924352, lng:-77.6734802079553, zm:9});

			// var kmlApurimac = '<?php echo $urlKml.'kml/apurimac.kml'; ?>';
			// kmlApurimacLayer = new google.maps.KmlLayer ( kmlApurimac, {preserveViewport:true});
			// kmlArray.push({cd:'03', nomkml:kmlApurimacLayer, lat:-14.030814122799, lng:-72.9736536493109, zm:9});

			// var kmlArequipa = '<?php echo $urlKml.'kml/arequipa.kml'; ?>';
			// kmlArequipaLayer = new google.maps.KmlLayer ( kmlArequipa, {preserveViewport:true});
			// kmlArray.push({cd:'04', nomkml:kmlArequipaLayer, lat:-15.8418343150547, lng:-72.4808283366732, zm:8});

			// var kmlAyacucho = '<?php echo $urlKml.'kml/ayacucho.kml'; ?>';
			// kmlAyacuchoLayer = new google.maps.KmlLayer ( kmlAyacucho, {preserveViewport:true});
			// kmlArray.push({cd:'05', nomkml:kmlAyacuchoLayer, lat:-14.0892883309093, lng:-74.075890651585, zm:8});

			// var kmlCajamarca = '<?php echo $urlKml.'kml/cajamarca.kml'; ?>';
			// kmlCajamarcaLayer = new google.maps.KmlLayer ( kmlCajamarca, {preserveViewport:true});
			// kmlArray.push({cd:'06', nomkml:kmlCajamarcaLayer, lat:-6.43276922845617, lng:-78.7435054751844, zm:8});

			// var kmlCallao = '<?php echo $urlKml.'kml/callao.kml'; ?>';
			// kmlCallaoLayer = new google.maps.KmlLayer ( kmlCallao, {preserveViewport:true});
			// kmlArray.push({cd:'07', nomkml:kmlCallaoLayer, lat:-11.955555624777, lng:-77.1416258913623, zm:12});

			// var kmlCusco = '<?php echo $urlKml.'kml/cusco.kml'; ?>';
			// kmlCuscoLayer = new google.maps.KmlLayer ( kmlCusco, {preserveViewport:true});
			// kmlArray.push({cd:'08', nomkml:kmlCuscoLayer, lat:-13.2000014858382, lng:-72.1637731157334, zm:9});

			// var kmlHuancavelica = '<?php echo $urlKml.'kml/huancavelica.kml'; ?>';
			// kmlHuancavelicaLayer = new google.maps.KmlLayer ( kmlHuancavelica, {preserveViewport:true});
			// kmlArray.push({cd:'09', nomkml:kmlHuancavelicaLayer, lat:-13.0287170903714, lng:-75.0036723168008, zm:9});

			// var kmlHuanuco = '<?php echo $urlKml.'kml/huanuco.kml'; ?>';
			// kmlHuanucoLayer = new google.maps.KmlLayer ( kmlHuanuco, {preserveViewport:true});
			// kmlArray.push({cd:'10', nomkml:kmlHuanucoLayer, lat:-9.41976048562642, lng:-76.0330524961483, zm:9});

			// var kmlIca = '<?php echo $urlKml.'kml/ica.kml'; ?>';
			// kmlIcaLayer = new google.maps.KmlLayer ( kmlIca, {preserveViewport:true});
			// kmlArray.push({cd:'11', nomkml:kmlIcaLayer, lat:-14.2334842159937, lng:-75.5735306802363, zm:9});

			// var kmlJunin = '<?php echo $urlKml.'kml/junin.kml'; ?>';
			// kmlJuninLayer = new google.maps.KmlLayer ( kmlJunin, {preserveViewport:true});
			// kmlArray.push({cd:'12', nomkml:kmlJuninLayer, lat:-11.5436597300396, lng:-74.8749510303952, zm:8});

			// var kmlLibertad = '<?php echo $urlKml.'kml/libertad.kml'; ?>'
			// kmlLibertadLayer = new google.maps.KmlLayer ( kmlLibertad, {preserveViewport:true});
			// kmlArray.push({cd:'13', nomkml:kmlLibertadLayer, lat:-7.9169754349312, lng:-78.3810111865851, zm:8});

			// var kmlLambayeque = '<?php echo $urlKml.'kml/lambayeque.kml'; ?>'
			// kmlLambayequeLayer = new google.maps.KmlLayer ( kmlLambayeque, {preserveViewport:true});
			// kmlArray.push({cd:'14', nomkml:kmlLambayequeLayer, lat:-6.36380361377563, lng:-79.8249923276084, zm:8});

			// var kmlLima = '<?php echo $urlKml.'kml/lima.kml'; ?>';
			// kmlLimaLayer = new google.maps.KmlLayer ( kmlLima, {preserveViewport:true});
			// kmlArray.push({cd:'15', nomkml:kmlLimaLayer, lat:-11.7866731456649, lng:-76.6324097107669, zm:8});

			// var kmlLoreto = '<?php echo $urlKml.'kml/loreto.kml'; ?>';
			// kmlLoretoLayer = new google.maps.KmlLayer ( kmlLoreto, {preserveViewport:true});
			// kmlArray.push({cd:'16', nomkml:kmlLoretoLayer, lat:-4.12302517090165, lng:-74.4265053944273, zm:7});

			// var kmlMadre = '<?php echo $urlKml.'kml/madre.kml'; ?>';
			// kmlMadreLayer = new google.maps.KmlLayer ( kmlMadre, {preserveViewport:true});
			// kmlArray.push({cd:'17', nomkml:kmlMadreLayer, lat:-11.9781015474597, lng:-70.5450541729619, zm:9});

			// var kmlMoquegua = '<?php echo $urlKml.'kml/moquegua.kml'; ?>';
			// kmlMoqueguaLayer = new google.maps.KmlLayer ( kmlMoquegua, {preserveViewport:true});
			// kmlArray.push({cd:'18', nomkml:kmlMoqueguaLayer, lat:-16.8651923223222, lng:-70.8510673506577, zm:8});

			// var kmlPasco = '<?php echo $urlKml.'kml/pasco.kml'; ?>';
			// kmlPascoLayer = new google.maps.KmlLayer ( kmlPasco, {preserveViewport:true});
			// kmlArray.push({cd:'19', nomkml:kmlPascoLayer, lat:-10.4033365152324, lng:-75.3099258151342, zm:9});

			// var kmlPiura = '<?php echo $urlKml.'kml/piura.kml'; ?>';
			// kmlPiuraLayer = new google.maps.KmlLayer ( kmlPiura, {preserveViewport:true});
			// kmlArray.push({cd:'20', nomkml:kmlPiuraLayer, lat:-5.12938480280296, lng:-80.3297169479797, zm:8});  

			// var kmlPuno = '<?php echo $urlKml.'kml/puno.kml'; ?>';
			// kmlPunoLayer = new google.maps.KmlLayer ( kmlPuno, {preserveViewport:true});
			// kmlArray.push({cd:'21', nomkml:kmlPunoLayer, lat:-14.9320741925803, lng:-69.9489916069943, zm:8});

			// var kmlMartin = '<?php echo $urlKml.'kml/martin.kml'; ?>';
			// kmlMartinLayer = new google.maps.KmlLayer ( kmlMartin, {preserveViewport:true});
			// kmlArray.push({cd:'22', nomkml:kmlMartinLayer, lat:-7.03440262104589, lng:-76.7157680323349, zm:9});

			// var kmlTacna = '<?php echo $urlKml.'kml/tacna.kml'; ?>';
			// kmlTacnaLayer = new google.maps.KmlLayer ( kmlTacna, {preserveViewport:true});
			// kmlArray.push({cd:'23', nomkml:kmlTacnaLayer, lat:-17.6416549925828, lng:-70.2785118500858, zm:8});

			// var kmlTumbes = '<?php echo $urlKml.'kml/tumbes.kml'; ?>';
			// kmlTumbesLayer = new google.maps.KmlLayer ( kmlTumbes, {preserveViewport:true});
			// kmlArray.push({cd:'24', nomkml:kmlTumbesLayer, lat:-3.85033718439041, lng:-80.541902047432, zm:9});

			// var kmlUcayali = '<?php echo $urlKml.'kml/ucayali.kml'; ?>';
			// kmlUcayaliLayer = new google.maps.KmlLayer ( kmlUcayali, {preserveViewport:true});
			// kmlArray.push({cd:'25', nomkml:kmlUcayaliLayer, lat:-9.61980385850328, lng:-73.4371206808515, zm:8});

			// var kmlLimaMetro = '<?php echo $urlKml.'kml/limametro.kml'; ?>';
			// kmlLimaMetroLayer = new google.maps.KmlLayer ( kmlLimaMetro, {preserveViewport:true});
			// kmlArray.push({cd:'1501', nomkml:kmlLimaMetroLayer, lat:-11.7866731456649, lng:-76.6324097107669, zm:8});

			// var kmlLimaProv = '<?php echo $urlKml.'kml/limaprov.kml'; ?>';
			// kmlLimaProvLayer = new google.maps.KmlLayer ( kmlLimaProv, {preserveViewport:true});
			// kmlArray.push({cd:'1502', nomkml:kmlLimaProvLayer, lat:-11.7866731456649, lng:-76.6324097107669, zm:8});

			// kmlArray[2].nomkml.setMap(map);
			// kmlArray[4].nomkml.setMap(map);
			// kmlArray[7].nomkml.setMap(map);
			// kmlArray[11].nomkml.setMap(map);
			// kmlArray[13].nomkml.setMap(map);
			// kmlArray[14].nomkml.setMap(map);
			// kmlArray[18].nomkml.setMap(map);
			// kmlArray[20].nomkml.setMap(map);
			// kmlArray[23].nomkml.setMap(map);
			// kmlArray[24].nomkml.setMap(map);



			// capaKml = new google.maps.FusionTablesLayer("1GpIA0mBHMTame6QFenQeQCazLW4NiLciy3lfLvSZ");
			// capaKml.setQuery("SELECT 'geometry' FROM 1GpIA0mBHMTame6QFenQeQCazLW4NiLciy3lfLvSZ WHERE Departamento IN ('Ica', 'Piura', 'Tacna', 'Ancash', 'Callao', 'Tumbes', 'Arequipa', 'La Libertad', 'Lambayeque', 'Moquegua')");
			// capaKml.setMap(map);

			// capaKml = new google.maps.FusionTablesLayer({
			// 	query: {
			// 		select: "geometry",
			// 		from: "1GpIA0mBHMTame6QFenQeQCazLW4NiLciy3lfLvSZ",
			// 		where: "Departamento IN ('Ica', 'Piura', 'Tacna', 'Ancash', 'Callao', 'Tumbes', 'Arequipa', 'La Libertad', 'Lambayeque', 'Moquegua')"
			// 	},
			// 	options: {
			// 		styleId: 2,
			// 		templateId: 2
			// 	}
			// });
			// capaKml.setMap(map);

			depa_region();
			
		}

		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			
			initialize();
			// depa_region();
			// load_ubigeo('DEP');

			$('#region').change(function(event){

				if ( layer != undefined ) layer.setMap(null);
				$('#cat').val(-1);
				depa_region();
			});


			$('#cat').change(function(event){
				load_fusiontable( );
			});


			$('#depa').change(function(event){

				// $('#prov').empty();
				// $("#prov").append('<option value="0">TODOS...</option>');
				// if ( $(this).val() != 0 )  load_ubigeo('PROV');
				// $('#dist').html('<option value="0">TODOS...</option>');

				// if ( $(this).val() != 0 ) kml_dpto($(this).val()); else depa_region();
				


				// for (var i = 0; i < kmlArray.length; i++) {
				// 	kmlArray[i].nomkml.setMap(null);
				// }

				// param = "WHERE Ubigeo = " + ;
				load_kml_ft( table_dpto, $(this).val() );
				load_fusiontable();

			});

			$('#prov').change(function(event){

				$('#dist').empty();
				$("#dist").append('<option value="0">TODOS...</option>');
				if ( $(this).val() != 0 ) load_ubigeo('DIST');
				
				load_fusiontable( );

			});

			$('#dist').change(function(event){
				load_fusiontable( );
			});


		});

		function load_fusiontable( ) {

			if ( layer != undefined ) layer.setMap(null);

			if ( $('#cat').val() != -1 ) {

				maploaded = false;
				checkGoogleMap();

				tabla = $('#region').val();

				condicion = ( $('#cat').val() > 0 ) ? 'Categoria = '+$('#cat').val()+'' : 'Categoria > 0';
				condicion += ( $('#depa').val() != 0 && $('#depa').val() != 15  ) ? " AND CCDD = '"+$('#depa').val()+"'" : '';
				condicion += ( $('#prov').val() != 0 ) ? " AND CCPP = '"+$('#prov').val()+"'" : '';
				condicion += ( $('#dist').val() != 0 ) ? " AND CCDI = '"+$('#dist').val()+"'" : '';


				var interval = setInterval(function(){
						clearInterval(interval);
						
						layer = new google.maps.FusionTablesLayer({
							// map:map,
							query: {
								select: " * ",
								from: tabla,
								where: condicion
							},
							options: {
								styleId: 2,
								templateId: 2
							}
						});

						layer.setMap(map);

						maploaded = true;
						setTimeout('checkGoogleMap()',1000);
				}, 3000);

			}
			
		}

		function kml_dpto(code){

			ckb = ($('#ckb_kml').is(':checked')) ? 0 : 1;

			for (var i = 0; i < kmlArray.length; i++) {

				kmlArray[i].nomkml.setMap(null);

				if (kmlArray[i].cd == code){
					if ( ckb == 1 ){
						kmlArray[i].nomkml.setMap(map);
					}
					map.setCenter(new google.maps.LatLng(kmlArray[i].lat,kmlArray[i].lng));
					map.setZoom(kmlArray[i].zm);
				}
			}
		}

		// clean para cmb dinamico
		function clean_kml_dpto(){

			ckb = ($('#ckb_kml').is(':checked')) ? 0 : 1;
			code = parseInt( $('#depa').val() );

			for (var i = 0; i < kmlArray.length; i++) {
				kmlArray[i].nomkml.setMap(null);
			}
			if ( ckb == 1 ){
				kmlArray[code].nomkml.setMap(map);
				map.setCenter(new google.maps.LatLng(kmlArray[code].lat,kmlArray[code].lng));
			}
		}

		function depa_region() {

			$('#depa').empty();
			$('#depa').append('<option value="0">TODOS...</option>');

			// for (var i = 0; i < kmlArray.length; i++) {
			// 	kmlArray[i].nomkml.setMap(null);
			// }

			zomCenter = new google.maps.LatLng(-9.817329,-69.920655);
			zom = 6;

			switch ( $('#region option:selected').attr('id') ){
				case '0':
					condicion = "Departamento IN ('Ica', 'Piura', 'Tacna', 'Ancash', 'Callao', 'Tumbes', 'Arequipa', 'La Libertad', 'Lambayeque', 'Moquegua')";
					// kmlArray[2].nomkml.setMap(map);
					// kmlArray[4].nomkml.setMap(map);
					// kmlArray[7].nomkml.setMap(map);
					// kmlArray[11].nomkml.setMap(map);
					// kmlArray[13].nomkml.setMap(map);
					// kmlArray[14].nomkml.setMap(map);
					// kmlArray[18].nomkml.setMap(map);
					// kmlArray[20].nomkml.setMap(map);
					// kmlArray[23].nomkml.setMap(map);
					// kmlArray[24].nomkml.setMap(map);
					break;
				case '1':
					condicion = "Departamento IN ('Puno', 'Cusco', 'Junin', 'Pasco', 'Ayacucho', 'Apurimac', 'Cajamarca', 'Huancavelica', 'Huanuco')";
					// kmlArray[3].nomkml.setMap(map);
					// kmlArray[5].nomkml.setMap(map);
					// kmlArray[6].nomkml.setMap(map);
					// kmlArray[8].nomkml.setMap(map);
					// kmlArray[9].nomkml.setMap(map);
					// kmlArray[10].nomkml.setMap(map);
					// kmlArray[12].nomkml.setMap(map);
					// kmlArray[19].nomkml.setMap(map);
					// kmlArray[21].nomkml.setMap(map);
					break;
				case '2':
					condicion = "Departamento IN ('MadredeDios', 'Ucayali', 'Amazonas', 'Loreto', 'SanMartin')";
					// kmlArray[1].nomkml.setMap(map);
					// kmlArray[16].nomkml.setMap(map);
					// kmlArray[17].nomkml.setMap(map);
					// kmlArray[22].nomkml.setMap(map);
					// kmlArray[25].nomkml.setMap(map);
					// map.setCenter( new google.maps.LatLng(-9.817329,-69.920655) );
					// map.setZoom(6);
					break;
				case '3':
					condicion = "Departamento = 'Lima'";
					$('#depa').empty();
						// kml_dpto(15);
					zomCenter = new google.maps.LatLng(-11.7866731456649,-76.6324097107669);
					zom = 8;
					break;
			}

			if ( capaKml != undefined ) capaKml.setMap(null);
			capaKml = new google.maps.FusionTablesLayer({
				query: {
					select: "geometry",
					from: table_dpto,
					where: condicion
				},
				options: {
					styleId: 2,
					templateId: 2
				}
			});
			capaKml.setMap(map);

			map.setCenter( zomCenter );
			map.setZoom( zom );

			load_ubigeo('DEP');
		}

		function load_ubigeo(name) {

			indice1 = $('#region option:selected').attr('id');
			indice2 = $('#depa option:selected').attr('id');
			indice3 = $('#prov option:selected').attr('id');
			
			$.ajax({
				type: "POST",
				url: "<?php echo $ruta; ?>json/region.json",
				dataType:'json',
				success: function(json_data){

					if ( name == 'DEP' ){
						for (var k in json_data.Region[indice1].Departamento) {
							$("#depa").append('<option id="' + k + '" value="' + json_data.Region[indice1].Departamento[k].CCDD + '" >' + json_data.Region[indice1].Departamento[k].Nombre + '</option>');
						}

					}else if ( name == 'PROV'){
						for (var k in json_data.Region[indice1].Departamento[indice2].PROVINCIA) {
							$("#prov").append('<option id="' + k + '" value="' + json_data.Region[indice1].Departamento[indice2].PROVINCIA[k].CCPP + '" >' +json_data.Region[indice1].Departamento[indice2].PROVINCIA[k].Nombre + '</option>');
						}

					}else if ( name == 'DIST'){
						for (var k in json_data.Region[indice1].Departamento[indice2].PROVINCIA[indice3].DISTRITO) {
							$("#dist").append('<option id="' + k + '" value="' + json_data.Region[indice1].Departamento[indice2].PROVINCIA[indice3].DISTRITO[k].CCDI + '" >' +json_data.Region[indice1].Departamento[indice2].PROVINCIA[indice3].DISTRITO[k].Nombre + '</option>');
						}

					}
				}
			});

		}

		function load_kml_ft( tabla, code ) {

			capaKml.setMap(null);

			capaKml = new google.maps.FusionTablesLayer({
				query: {
					select: "geometry",
					from: tabla,
					where: "Ubigeo = " + code
				},
				options: {
					styleId: 2,
					templateId: 2
				}
			});
			capaKml.setMap(map);


			var queryText = "SELECT Ubigeo, geometry FROM " + tabla + " Where Ubigeo = " + code;
			// alert(queryText);
			// '1GpIA0mBHMTame6QFenQeQCazLW4NiLciy3lfLvSZ where Ubigeo ='+code;
			var encodedQuery = encodeURIComponent(queryText);

			var query = new google.visualization.Query('http://www.google.com/fusiontables/gvizdata?tq=' + queryText);

			query.send(zoomTo);


			// var query = "SELECT CCDD, geometry, Latitud, Longitud, Zoom FROM " +
			// '138N8IQvq9qVSuDwrlY_EpcHXu4g5NZQZ522oR5Vs';
			// var encodedQuery = encodeURIComponent(query);

			// // Construct the URL
			// var url = ['https://www.googleapis.com/fusiontables/v1/query'];
			// url.push('?sql=' + encodedQuery);
			// url.push('&key=AIzaSyAkIa4SdnQDXiuLkg2tPW42vgVrR9wWarA');
			// url.push('&callback=?');


			// $.getJSON(url.join(''),null,function( data ) {
			// 	var rows = data['rows'];
			// 	for (i in rows) {
			// 		var codigo = rows[i][0];
			// 		var geo = rows[i][1];
			// 		var lat = rows[i][2];
			// 		var lng = rows[i][3];
			// 		var zom = rows[i][4];
			// 		map.setCenter( new google.maps.LatLng(lat,lng) );
			// 		map.setZoom(parseFloat(zom));
			// 	}
			// });

		}

		function zoomTo(response) {
			if (!response) {
				alert('no response');
				return;
			}
			if (response.isError()) {
				alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
				return;
			} 
			FTresponse = response;
			//for more information on the response object, see the documentation
			//http://code.google.com/apis/visualization/documentation/reference.html#QueryResponse
			// numRows = response.getDataTable().getNumberOfRows();
			// numCols = response.getDataTable().getNumberOfColumns();

			var kml =  FTresponse.getDataTable().getValue(0,1);
			// create a geoXml3 parser for the click handlers
			var geoXml = new geoXML3.parser({
				map: map,
				zoom: false
			});

			geoXml.parseKmlString("<Placemark>"+kml+"</Placemark>");
			geoXml.docs[0].gpolygons[0].setMap(null);
			map.fitBounds(geoXml.docs[0].gpolygons[0].bounds);

			/*
			var bounds = new google.maps.LatLngBounds();
			for(i = 0; i < numRows; i++) {
			var point = new google.maps.LatLng(
			parseFloat(response.getDataTable().getValue(i, 0)),
			parseFloat(response.getDataTable().getValue(i, 1)));
			bounds.extend(point);
			}
			// zoom to the bounds
			map.fitBounds(bounds);
			*/
		}



	</script>

</head>
<body>

	<div id="header" style="display: block;">
		<a id="logo" href="#"><img src="" alt="Puntos Informatio"></a>
		<div id="oted">Oficina Técnica de Estadísticas Departamentales - OTED</div>
	</div>

	<div id="cuerpo" >
		<div id="msg"></div>
		<div class="map_container">
			<div id="map-canvas"></div>
		</div>

		<div class="filtro_map preguntas_sub2 span2">
			<div class="row-fluid control-group span9">
				<input type="checkbox" name="ckb_kml" id="ckb_kml" onclick="clean_kml_dpto();" > Ocultar KML
			</div>

			<div class="row-fluid control-group span9">
				<label class="preguntas_sub2" for="region">REGION</label>
				<div class="controls span">
					<select id="region" class="span12" name="region">
						<option id="0" value="1XKxUzwHeO0mrxwXoIhliYKBtWIj2Q_NHSKZbhnrX">COSTA</option>
						<!-- <option id="0" value="1DpUiANvGr2JhRDccQIFbIEemzwq1glvq6rejJ_aO">COSTA</option> -->
						<option id="1" value="1wJ-5f5BeI_n0qH3OeyMxKcO90-8eCNgSFnvtzs1x">SIERRA</option>
						<option id="2" value="1CMrmsdHyYXCx3Jepdnede8pwZZy0qiMvYVqT75aj">SELVA</option>
						<option id="3" value="1YvW7aDv4CXq_hz2japbXTyMvgscLMnCJXz8V7z29">LIMA</option>
					</select>
				</div>
			</div>

			<div id="dv_cat" class="row-fluid control-group span9">
				<label class="preguntas_sub2" for="cat">CATEGORIA</label>
				<div class="controls">
					<select id="cat" class="span12" name="cat">
						<option value="-1">SELECCIONE...</option>
						<option value="0">TODOS</option>
						<option value="1">CENTRO POBLADO</option>
						<option value="2">ESTABLECIMIENTO DE SALUD</option>
						<option value="3">INSTITUCION EDUCATIVA</option>
					</select>
				</div>
			</div>

			<div id="dv_dep" class="row-fluid control-group span9">
				<label class="preguntas_sub2" for="depa">DEPARTAMENTO</label>
				<div class="controls">
					<select id="depa" class="span12" name="depa">
						<!-- ajax -->
					</select>
				</div>
			</div>

			<div id="dv_prov" class="row-fluid control-group span9">
				<label class="preguntas_sub2" for="prov">PROVINCIA</label>
				<div class="controls">
					<select id="prov" class="span12" name="prov">
						<option id="0" value="0">TODOS...</option>
						<!-- ajax -->
					</select>
				</div>
			</div>

			<div id="dv_dist" class="row-fluid control-group span9">
				<label class="preguntas_sub2" for="dist">DISTRITO</label>
				<div class="controls">
					<select id="dist" class="span12" name="dist">
						<option id="0" value="0">TODOS...</option>
						<!-- ajax -->
					</select>
				</div>
			</div>
			
	</div>

	<div id="footer">
		<div class="container-fluid">
			<div class="row-fluid">
				<div id="geo_leyenda" class="span9">
					<!-- ajax -->
				</div>
				<div id="subtitulo" class="span3">
					<!-- ajax -->
				</div>
			</div>
		</div>
	</div>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-47317828-1', 'inei.gob.pe');
	  ga('send', 'pageview');

	</script>
	
</body>
</html>
