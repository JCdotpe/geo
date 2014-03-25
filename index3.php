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

	<script type="text/javascript">
		
		var kmlArray = [];
		var maploaded = false;
		var layer;

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

			google.maps.visualRefresh = true;

			var myOptions = {
				zoom: 6,
				center: new google.maps.LatLng(-9.817329,-69.920655),
				// mapTypeId: google.maps.MapTypeId.SATELLITE,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				zoomControl: true,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.LARGE,
					position: google.maps.ControlPosition.RIGHT_CENTER
				},
				streetViewControl: true,
				streetViewControlOptions:{
					position: google.maps.ControlPosition.RIGHT_CENTER
				},
				panControl: false,
				panControlOptions: {
					position: google.maps.ControlPosition.RIGHT_CENTER
				},
				scaleControl: false,
				scaleControlOptions: {
					position: google.maps.ControlPosition.RIGHT_CENTER
				},
				mapTypeControl: true,
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
					position: google.maps.ControlPosition.RIGHT_CENTER
				}
			}

			map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

			layer = new google.maps.FusionTablesLayer({
				map:map,
				query: {
					select: " * ",
					from: '19htl4A47jXNor4Qz_LHLTcKutbju6KNhUQ7ThxSP',
					where: ''
				},
				options: {
					styleId: 2,
					templateId: 2
				}
			});

			<?php $urlKml = 'http://webinei.inei.gob.pe/cie/2013/web/'; ?>
			var kmlPeru = '<?php echo $urlKml.'kml/peru.kml'."?nocache|=".time(); ?>';
			// var kmlPeru = 'http://www.uxglass.com/kml/demo.kml';
			// http://www.uxglass.com/lenguas/departamento/


			kmlPeruLayer = new google.maps.KmlLayer ( kmlPeru, {preserveViewport:true});
			kmlArray.push({cd:'0', nomkml:kmlPeruLayer, lat:-9.817329, lng:-69.920655, zm:6});
			kmlArray[0].nomkml.setMap(map);

			// KML MAPS LAYERS
			var kmlAmazonas = '<?php echo $urlKml.'kml/amazonas.kml'."?nocache|=".time(); ?>';
			kmlAmazonasLayer = new google.maps.KmlLayer ( kmlAmazonas, {preserveViewport:true});
			kmlArray.push({cd:'01', nomkml:kmlAmazonasLayer, lat:-5.06036873877975, lng:-78.056629714081, zm:8});

			var kmlAncash = '<?php echo $urlKml.'kml/ancash.kml'."?nocache|=".time(); ?>';
			kmlAncashLayer = new google.maps.KmlLayer ( kmlAncash, {preserveViewport:true});  
			kmlArray.push({cd:'02', nomkml:kmlAncashLayer, lat:-9.40575405924352, lng:-77.6734802079553, zm:9});

			var kmlApurimac = '<?php echo $urlKml.'kml/apurimac.kml'."?nocache|=".time(); ?>';
			kmlApurimacLayer = new google.maps.KmlLayer ( kmlApurimac, {preserveViewport:true});
			kmlArray.push({cd:'03', nomkml:kmlApurimacLayer, lat:-14.030814122799, lng:-72.9736536493109, zm:9});

			var kmlArequipa = '<?php echo $urlKml.'kml/arequipa.kml'."?nocache|=".time(); ?>';
			kmlArequipaLayer = new google.maps.KmlLayer ( kmlArequipa, {preserveViewport:true});
			kmlArray.push({cd:'04', nomkml:kmlArequipaLayer, lat:-15.8418343150547, lng:-72.4808283366732, zm:8});

			var kmlAyacucho = '<?php echo $urlKml.'kml/ayacucho.kml'."?nocache|=".time(); ?>';
			kmlAyacuchoLayer = new google.maps.KmlLayer ( kmlAyacucho, {preserveViewport:true});
			kmlArray.push({cd:'05', nomkml:kmlAyacuchoLayer, lat:-14.0892883309093, lng:-74.075890651585, zm:8});

			var kmlCajamarca = '<?php echo $urlKml.'kml/cajamarca.kml'."?nocache|=".time(); ?>';
			kmlCajamarcaLayer = new google.maps.KmlLayer ( kmlCajamarca, {preserveViewport:true});
			kmlArray.push({cd:'06', nomkml:kmlCajamarcaLayer, lat:-6.43276922845617, lng:-78.7435054751844, zm:8});

			var kmlCallao = '<?php echo $urlKml.'kml/callao.kml'."?nocache|=".time(); ?>';
			kmlCallaoLayer = new google.maps.KmlLayer ( kmlCallao, {preserveViewport:true});
			kmlArray.push({cd:'07', nomkml:kmlCallaoLayer, lat:-11.955555624777, lng:-77.1416258913623, zm:12});

			var kmlCusco = '<?php echo $urlKml.'kml/cusco.kml'."?nocache|=".time(); ?>';
			kmlCuscoLayer = new google.maps.KmlLayer ( kmlCusco, {preserveViewport:true});
			kmlArray.push({cd:'08', nomkml:kmlCuscoLayer, lat:-13.2000014858382, lng:-72.1637731157334, zm:9});

			var kmlHuancavelica = '<?php echo $urlKml.'kml/huancavelica.kml'."?nocache|=".time(); ?>';
			kmlHuancavelicaLayer = new google.maps.KmlLayer ( kmlHuancavelica, {preserveViewport:true});
			kmlArray.push({cd:'09', nomkml:kmlHuancavelicaLayer, lat:-13.0287170903714, lng:-75.0036723168008, zm:9});

			var kmlHuanuco = '<?php echo $urlKml.'kml/huanuco.kml'."?nocache|=".time(); ?>';
			kmlHuanucoLayer = new google.maps.KmlLayer ( kmlHuanuco, {preserveViewport:true});
			kmlArray.push({cd:'10', nomkml:kmlHuanucoLayer, lat:-9.41976048562642, lng:-76.0330524961483, zm:9});

			var kmlIca = '<?php echo $urlKml.'kml/ica.kml'."?nocache|=".time(); ?>';
			kmlIcaLayer = new google.maps.KmlLayer ( kmlIca, {preserveViewport:true});
			kmlArray.push({cd:'11', nomkml:kmlIcaLayer, lat:-14.2334842159937, lng:-75.5735306802363, zm:9});

			var kmlJunin = '<?php echo $urlKml.'kml/junin.kml'."?nocache|=".time(); ?>';
			kmlJuninLayer = new google.maps.KmlLayer ( kmlJunin, {preserveViewport:true});
			kmlArray.push({cd:'12', nomkml:kmlJuninLayer, lat:-11.5436597300396, lng:-74.8749510303952, zm:8});

			var kmlLibertad = '<?php echo $urlKml.'kml/libertad.kml'."?nocache|=".time(); ?>'
			kmlLibertadLayer = new google.maps.KmlLayer ( kmlLibertad, {preserveViewport:true});
			kmlArray.push({cd:'13', nomkml:kmlLibertadLayer, lat:-7.9169754349312, lng:-78.3810111865851, zm:8});

			var kmlLambayeque = '<?php echo $urlKml.'kml/lambayeque.kml'."?nocache|=".time(); ?>'
			kmlLambayequeLayer = new google.maps.KmlLayer ( kmlLambayeque, {preserveViewport:true});
			kmlArray.push({cd:'14', nomkml:kmlLambayequeLayer, lat:-6.36380361377563, lng:-79.8249923276084, zm:8});

			var kmlLima = '<?php echo $urlKml.'kml/lima.kml'."?nocache|=".time(); ?>';
			kmlLimaLayer = new google.maps.KmlLayer ( kmlLima, {preserveViewport:true});
			kmlArray.push({cd:'15', nomkml:kmlLimaLayer, lat:-11.7866731456649, lng:-76.6324097107669, zm:8});

			var kmlLoreto = '<?php echo $urlKml.'kml/loreto.kml'."?nocache|=".time(); ?>';
			kmlLoretoLayer = new google.maps.KmlLayer ( kmlLoreto, {preserveViewport:true});
			kmlArray.push({cd:'16', nomkml:kmlLoretoLayer, lat:-4.12302517090165, lng:-74.4265053944273, zm:7});

			var kmlMadre = '<?php echo $urlKml.'kml/madre.kml'."?nocache|=".time(); ?>';
			kmlMadreLayer = new google.maps.KmlLayer ( kmlMadre, {preserveViewport:true});
			kmlArray.push({cd:'17', nomkml:kmlMadreLayer, lat:-11.9781015474597, lng:-70.5450541729619, zm:9});

			var kmlMoquegua = '<?php echo $urlKml.'kml/moquegua.kml'."?nocache|=".time(); ?>';
			kmlMoqueguaLayer = new google.maps.KmlLayer ( kmlMoquegua, {preserveViewport:true});
			kmlArray.push({cd:'18', nomkml:kmlMoqueguaLayer, lat:-16.8651923223222, lng:-70.8510673506577, zm:8});

			var kmlPasco = '<?php echo $urlKml.'kml/pasco.kml'."?nocache|=".time(); ?>';
			kmlPascoLayer = new google.maps.KmlLayer ( kmlPasco, {preserveViewport:true});
			kmlArray.push({cd:'19', nomkml:kmlPascoLayer, lat:-10.4033365152324, lng:-75.3099258151342, zm:9});

			var kmlPiura = '<?php echo $urlKml.'kml/piura.kml'."?nocache|=".time(); ?>';
			kmlPiuraLayer = new google.maps.KmlLayer ( kmlPiura, {preserveViewport:true});
			kmlArray.push({cd:'20', nomkml:kmlPiuraLayer, lat:-5.12938480280296, lng:-80.3297169479797, zm:8});  

			var kmlPuno = '<?php echo $urlKml.'kml/puno.kml'."?nocache|=".time(); ?>';
			kmlPunoLayer = new google.maps.KmlLayer ( kmlPuno, {preserveViewport:true});
			kmlArray.push({cd:'21', nomkml:kmlPunoLayer, lat:-14.9320741925803, lng:-69.9489916069943, zm:8});

			var kmlMartin = '<?php echo $urlKml.'kml/martin.kml'."?nocache|=".time(); ?>';
			kmlMartinLayer = new google.maps.KmlLayer ( kmlMartin, {preserveViewport:true});
			kmlArray.push({cd:'22', nomkml:kmlMartinLayer, lat:-7.03440262104589, lng:-76.7157680323349, zm:9});

			var kmlTacna = '<?php echo $urlKml.'kml/tacna.kml'."?nocache|=".time(); ?>';
			kmlTacnaLayer = new google.maps.KmlLayer ( kmlTacna, {preserveViewport:true});
			kmlArray.push({cd:'23', nomkml:kmlTacnaLayer, lat:-17.6416549925828, lng:-70.2785118500858, zm:8});

			var kmlTumbes = '<?php echo $urlKml.'kml/tumbes.kml'."?nocache|=".time(); ?>';
			kmlTumbesLayer = new google.maps.KmlLayer ( kmlTumbes, {preserveViewport:true});
			kmlArray.push({cd:'24', nomkml:kmlTumbesLayer, lat:-3.85033718439041, lng:-80.541902047432, zm:9});

			var kmlUcayali = '<?php echo $urlKml.'kml/ucayali.kml'."?nocache|=".time(); ?>';
			kmlUcayaliLayer = new google.maps.KmlLayer ( kmlUcayali, {preserveViewport:true});
			kmlArray.push({cd:'25', nomkml:kmlUcayaliLayer, lat:-9.61980385850328, lng:-73.4371206808515, zm:8});

			var kmlLimaMetro = '<?php echo $urlKml.'kml/limametro.kml'."?nocache|=".time(); ?>';
			kmlLimaMetroLayer = new google.maps.KmlLayer ( kmlLimaMetro, {preserveViewport:true});
			kmlArray.push({cd:'1501', nomkml:kmlLimaMetroLayer, lat:-11.7866731456649, lng:-76.6324097107669, zm:8});

			var kmlLimaProv = '<?php echo $urlKml.'kml/limaprov.kml'."?nocache|=".time(); ?>';
			kmlLimaProvLayer = new google.maps.KmlLayer ( kmlLimaProv, {preserveViewport:true});
			kmlArray.push({cd:'1502', nomkml:kmlLimaProvLayer, lat:-11.7866731456649, lng:-76.6324097107669, zm:8});
		}

		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			
			initialize();
			depa_region($('#region option:selected').text());

			$('#region').change(function(event){

				if ( layer != undefined ) layer.setMap(null);
				depa_region($('#region option:selected').text());
				tabla = $(this).val();

				layer = new google.maps.FusionTablesLayer({
					map:map,
					query: {
						select: " * ",
						from: tabla,
						where: ''
					},
					options: {
						styleId: 2,
						templateId: 2
					}
				});

				layer.setMap(map);

				maploaded = true;
				setTimeout('checkGoogleMap()',1000);

				$('#cat').val(0);
				
			});

			$('#cat').change(function(event){

				if ( layer != undefined ) layer.setMap(null);

				tabla = $('#region').val();

				condicion = ( $(this).val() != 0 ) ? 'Categoria = '+$(this).val()+'' : 'Categoria > 0';
				condicion += ( $('#depa').val() != 0 && $('#depa').val() != 15  ) ? " AND Departamento = '"+$('#depa option:selected').text()+"'" : '';

				layer = new google.maps.FusionTablesLayer({
					map:map,
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
			});


			$('#depa').change(function(event){

				// kml_dpto($(this).val());

				if ( layer != undefined ) layer.setMap(null);

				tabla = $('#region').val();

				condicion = ( $('#cat').val() != 0 ) ? 'Categoria = '+$('#cat').val()+'' : 'Categoria > 0';
				condicion += ( $(this).val() != 0 ) ? " AND Departamento = '"+$('#depa option:selected').text()+"'" : '';
				
				layer = new google.maps.FusionTablesLayer({
					map:map,
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

				
			});

		});

		function kml_dpto(code){

			// ckb = ($('#ckb_kml').is(':checked')) ? 0 : 1;

			// for (var i = 0; i < kmlArray.length; i++) {

			// 	kmlArray[i].nomkml.setMap(null);

			// 	if (kmlArray[i].cd == code){
			// 		if ( ckb == 1 ){
			// 			kmlArray[i].nomkml.setMap(map);
			// 		}
			// 		map.setCenter(new google.maps.LatLng(kmlArray[i].lat,kmlArray[i].lng));
			// 		map.setZoom(kmlArray[i].zm);
			// 	}
			// }
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

		function depa_region(text) {

			// kml_dpto(0);
			$('#depa').empty();
			$('#depa').removeAttr('disabled');
			html = '<option value="0">TODOS...</option>';

			switch (text){
				case 'COSTA':
					indice = 0;
					// html += '<option class="cmbsede" value="02">ANCASH</option>';
					// html += '<option class="cmbsede" value="04">AREQUIPA</option>';
					// html += '<option class="cmbsede" value="07">CALLAO</option>';
					// html += '<option class="cmbsede" value="11">ICA</option>';
					// html += '<option class="cmbsede" value="13">LA LIBERTAD</option>';
					// html += '<option class="cmbsede" value="14">LAMBAYEQUE</option>';
					// html += '<option class="cmbsede" value="18">MOQUEGUA</option>';
					// html += '<option class="cmbsede" value="20">PIURA</option>';
					// html += '<option class="cmbsede" value="23">TACNA</option>';
					// html += '<option class="cmbsede" value="24">TUMBES</option>';
					break;
				case 'SIERRA':
					indice = 1;
					// html += '<option class="cmbsede" value="03">APURIMAC</option>';
					// html += '<option class="cmbsede" value="05">AYACUCHO</option>';
					// html += '<option class="cmbsede" value="06">CAJAMARCA</option>';
					// html += '<option class="cmbsede" value="08">CUSCO</option>';
					// html += '<option class="cmbsede" value="09">HUANCAVELICA</option>';
					// html += '<option class="cmbsede" value="10">HUANUCO</option>';
					// html += '<option class="cmbsede" value="12">JUNIN</option>';
					// html += '<option class="cmbsede" value="19">PASCO</option>';
					// html += '<option class="cmbsede" value="21">PUNO</option>';
					break;
				case 'SELVA':
					indice = 2;
					// html += '<option class="cmbsede" value="01">AMAZONAS</option>';
					// html += '<option class="cmbsede" value="16">LORETO</option>';
					// html += '<option class="cmbsede" value="17">MADRE DE DIOS</option>';
					// html += '<option class="cmbsede" value="22">SAN MARTIN</option>';
					// html += '<option class="cmbsede" value="25">UCAYALI</option>';
					break;
				case 'LIMA':
						html = '<option value="15">LIMA</option>';
						$('#depa').attr('disabled','disabled');
						kml_dpto(15);
					break;
			}

			$('#depa').html(html);

			$.ajax({
				type: "POST",
				url: "<?php echo $ruta; ?>json/dpto.json",
				dataType:'json',
				success: function(json_data){
					// $.each(json_data.Region, function(i, data){
					// 	$("#depa").append('<option value="' + i + '">' + data.Nombre + '</option>');
					// });
					for (var k in json_data.Region[indice].Departamento) {
						$("#depa").append('<option id="' + k + '" value="' + json_data.Region[indice].Departamento[k].CCDD + '" >' + json_data.Region[indice].Departamento[k].Nombre + '</option>');
					}
				}
			});
			

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
						<option value="19htl4A47jXNor4Qz_LHLTcKutbju6KNhUQ7ThxSP">COSTA</option>
						<option value="1vELVbrVXvuIe3-eeWuCrK1AU_iwodCLkBdSftFZr">SIERRA</option>
						<option value="19hhVa38s2o-67tEcjF5rLTtWTjVjBHHQOQWLXOsc">SELVA</option>
						<option value="1ndHu5XHjN0jl76-GInep6TzMRPTJqpuJctPaYP-L">LIMA</option>
					</select>
				</div>
			</div>

			<div id="dv_dist" class="row-fluid control-group span9">
				<label class="preguntas_sub2" for="cat">CATEGORIA</label>
				<div class="controls">
					<select id="cat" class="span12" name="cat">
						<option value="0">TODOS...</option>
						<option value="1">CENTRO POBLADO</option>
						<option value="2">ESTABLECIMIENTO DE SALUD</option>
						<option value="3">INSTITUCION EDUCATIVA</option>
					</select>
				</div>
			</div>

			<div id="dv_prov" class="row-fluid control-group span9">
				<label class="preguntas_sub2" for="depa">DEPARTAMENTO</label>
				<div class="controls">
					<select id="depa" class="span12" name="depa">
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
