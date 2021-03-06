
<!DOCTYPE HTML> 
<html lang="en"> 
	<head> 

		<title>WebGL BVH Player</title> 
		<meta charset="utf-8"> 
		<style type="text/css"> 
			html{
				font-family: Times, serif;
			}
			body {
				
				background-color: #F8F8F8 ;
				margin: 0px;
				text-align: center;
				/*overflow: hidden;	*/
				color: #404040 ;			
			}
			p {
				font-size: 1.2em;
			}
			a{
				text-decoration: none;
			}
			a:hover{
				text-decoration: underline;
			}
			#wrapper{
				overflow: hidden;
				margin:0px auto;
				width: 1000px;
			}
			#container{
				overflow: hidden;
				position: absolute;
				background-color: #282828 ;
				margin: 0px auto;
				width:800px;
				height: 600px; 
				text-align: center;
				/*float: left;*/
				
			}
			#container2{
				/*position: absolute;*/
				float: right;
				margin: 0 auto;
				text-align: center;
				width:80%;
				max-width:200px;
				height: 600px; 
			}
			#bot{
				float: clear;
				color: #C8C8C8; 
				overflow: hidden;
				margin: 0 auto;
				text-align: center;
				width: 80%; 
				max-width: 800px;
			}
			.customButton {
				-moz-box-shadow:inset 0px 0px 0px -14px #ffffff;
				-webkit-box-shadow:inset 0px 0px 0px -14px #ffffff;
				box-shadow:inset 0px 0px 0px -14px #ffffff;
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #ebe8eb) );
				background:-moz-linear-gradient( center top, #ededed 5%, #ebe8eb 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#ebe8eb');
				background-color:#ededed;
				-moz-border-radius:5px;
				-webkit-border-radius:5px;
				border-radius:5px;
				border:1px solid #d6d6d6;
				display:inline-block;
				color:#807e80;
				/*font-family:times;*/
				font-size:0.8em;
				font-weight:bold;
				padding:3px 5px;
				text-decoration:none;
			}.customButton:hover {
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ebe8eb), color-stop(1, #ededed) );
				background:-moz-linear-gradient( center top, #ebe8eb 5%, #ededed 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ebe8eb', endColorstr='#ededed');
				color:#404040;
				background-color:#ebe8eb;
			}.customButton:active {

				position:relative;
				top:1px;
			}
			.scale{
				width: 150px;
			}
			.upvec{
				width: 35px;
			}
			.anim{
				width: 120px;
			}
			#playpause{
				padding:7px 5px;
				width:30px;
				height:26px;
				background: url("playpausePRE.png");
				background-color:#ededed;
			}
			#playpause:hover{
				background: url("playpauseHOVER.png");
				background-color:#ebe8eb;
			}
			#replay{

				padding:7px 5px;
				width:26px;
				height:26px;
				background-image: url("replay.png");
				background-size: cover;
				background-color:#ededed;
			}
			#replay:hover{
				background-image: url("replayhover.png");
				background-color:#ebe8eb;
			}
			footer {
				position: fixed;
				bottom:0px; 
				margin: 0px auto;
				width:100%;
				text-align: center;
			}

		</style> 
	</head> 
	<body> 
    	

    <?php 
	ini_set('memory_limit', '400M');
	$dafile = $_GET['id'];
	//$dafile = "C:\\wamp\\www\\BVH_View\\Cartwheel.bvh";
	//$variable1 = file_get_contents($dafile); 
	$variable1 = file_get_contents($dafile);

  	$hmm =  preg_split("/[\s]+/", $variable1);
	
	?> 
 		<h1>WebGL BVH Viewer</h1>
 		<div id="wrapper">
			<div id="container">
				   	<div id="bot">
				        <p> To rotate the camera, hold ALT and click and drag on the canvas. 
				        	To pan the camera, hold ALT and click and drag using the middle mouse button. 
				        	To zoom in and out, hold ALT and click and drag using the right mouse button.
				        </p>
			   		</div>
			</div> 
	        <div id="container2">
	        	<p>
	        		Animation Controls:
	        		<br>
		        	<button class="customButton anim" onclick='toggleTrace()'>Toggle Ghost</button>
		        	<br>
		        	<button class="customButton" id="playpause" onclick='pauseAnim()'></button>
		        	<button class="customButton" id="replay" onclick='replayAnim()'></button>
		        	<br>
		        	<button class="customButton anim" onclick='changeFrame(1)'>Frame +</button>
		        	<br>
		        	<button class="customButton anim" onclick='changeFrame(-1)'>Frame -</button>
		        </p>
	        	<p>
		        	Set Up Vector:
		        	<br>
		        	<button  class="customButton upvec" onclick='setUpVector(1,0,0)'>X</button>
		        	<button  class="customButton upvec" onclick='setUpVector(0,1,0)'>Y</button>
		        	<button  class="customButton upvec" onclick='setUpVector(0,0,1)'>Z</button>
		        	<br>
		        	<button  class="customButton upvec" onclick='setUpVector(-1,0,0)'>-X</button>
		        	<button  class="customButton upvec" onclick='setUpVector(0,-1,0)'>-Y</button>
		        	<button  class="customButton upvec" onclick='setUpVector(0,0,-1)'>-Z</button>
		        </p>
		        <p> Scale:
		        	<br>
		        	<button  class="customButton scale" onclick='scaleBones(1.4,1.4,1.4)'>Scale Bones Up</button>
		        	<button  class="customButton scale" onclick='scaleBones(0.8,0.8,0.8)'>Scale Bones Down</button>
		        	<button  class="customButton scale" onclick='scaleWorld(1.3,1.3,1.3)'>Scale World Up</button>
		        	<button  class="customButton scale" onclick='scaleWorld(0.7,0.7,0.7)'>Scale World Down</button>
		        </p>
		        <!--<p>
		        	<button class="customButton scale" onlick='hideControls()'>Hide Instructions</button>
		        </p>-->
	        	<!--<input id="scaleSlider" type="text" data-slider="true">Scale</input>-->
	        </div> 
	    </div>
	    <footer>
	    	2013 - Created by Emre Tanirgan and Kelsey Hurley. View source code <a href="https://github.com/emretanirgan/BVH_Viewer">here</a>.
	    </footer>
 
        
        
		
		<script type="text/javascript" src="Three2.js"></script> 
		<script type="text/javascript" src="RequestAnimationFrame.js"></script> 
		<script type ="text/javascript" src="TrackballCamera.js"></script>
        <script type ="text/javascript" src="Stats.js"></script>
 		<script type ="text/javascript" src="jquery-1.9.1.min.js"></script>
 		<!--<script src="simple-slider.js"></script>-->
		<!--<link href="simple-slider.css" rel="stylesheet" type="text/css" />-->
		<!--<script type="text/javascript" src="parseBVH.js"></script>-->
		<script type="text/javascript"> 
			
			
			//variables
			var traceOn = true;
			var paused = false;
			var apps = [];
			var camera, scene = -1;
			var gcount = 0;
			var ghostArray = new Array();
			var limbsArray = new Array();
			var frameCount = 0;
			var theBody = -1;
			var k = 0;
			var noMovement = new Array();
			var renderer, root, stats;
			var movement = new Array();
			var theWorldBody = new Array();
			var ghostLegMaterial = new THREE.MeshLambertMaterial({color: 0x6666FF, opacity:0.5});
			var ghostLimbMaterial = new THREE.MeshLambertMaterial({color: 0xCC0000, opacity:0.5});
			var offset = 0;
			var tracker = 0;
		
			var jointChannels = new Array();
			var jointIndices = new Array();
			theBody = new Array();
			var legMaterial = new THREE.MeshLambertMaterial({color: 0x6666FF});

 			var tester = new Array();
			
			var fps = 60;
			var ender = 0;
			var movementStart = 0;
			var loc = 0;
			var placeKeep = -1;
			var oBracket = 0;
			var cBracket = 0;
			var track = 0;
			var otrack = -1;
			var t =0;
			var BodyHolder = 0;
			var maxLimb = -100;


			//As long as you keep a consistent rotation order in the BVH file, this should work
			var rotationOrder = new Array();

			init();
		
			function toggleTrace(){
				if(traceOn){
					for (var i=0; i < gcount; i++){
						scene.removeObject(ghostArray[i][0]);
					}
				}
				else{
					for(var i = 0; i < gcount; i++){
						scene.addObject(ghostArray[i][0]);
					}
					
				}
				traceOn = !traceOn;
			}
			
			function init() {
 
				var w = 300;
				var h = 250;
 
				var fullWidth = w * 2;
				var fullHeight = h * 2;
 
				apps.push( new App( 'container', fullWidth, fullHeight, w * 0, h * 0, w, h ) );
				
 
			}

			function hideControls(){
				var controls = document.getElementById("bot");
				controls.style.visibility="hidden";
			}
			function setUpVector(x,y,z){
				//if camera is -1, it hasn't been created yet
				if(camera != -1){
					camera.up.set(x,y,z);
				}
			}

			//Currently only increases 1 frame
			function changeFrame(skipSize){
				//k+=skipSize;
				if(skipSize > 0){
					if (k<frameCount){
						animateFrame();
						k++;
					}
				}
				else if(skipSize < 0){
					console.log(k);
					if (k>0){
						animateFrameBack();
						k--;
					}
				}
				
			}

			//Pauses/plays animation
			function pauseAnim(){
				paused = !paused;
				console.log(this);
			}

			//Replay animation
			function replayAnim(){
				if(scene != -1){
					for(var i=0; i<ghostArray.length; i++){
						scene.removeObject(ghostArray[i][0]);
					}
					tracker = ((theBody.length-noMovement.length) *3) + 6;
					k = 0;
					offset = 0;
					gcount = 0;
					animate();
				}
			}

			//Scale everything in the world up/down
			function scaleWorld(x,y,z){

				if(scene != -1){
					theBody[0].scale = theBody[0].scale.multiplyScalar(x);
					//scene.objects[0].scale = scene.objects[0].scale.multiplyScalar(x);
					for(var i=0; i<ghostArray.length; i++){
						ghostArray[i][0].scale = ghostArray[i][0].scale.multiplyScalar(x);
					}
				}
			}

			//Scale just the bones
			function scaleBones(x,y,z){

				if(scene != -1){
					scaleBodyBones(theBody[0], x, y, z);
					/*for(var i = 0; i<ghostArray.length; i++){
						scaleBodyBones(ghostArray[i][0], x, y, z);
						drawLimbs(ghostArray, i, true);
					}*/
					drawLimbs(theBody, 1, false);
					

				}
			}

			function scaleBodyBones(parent, x, y, z){
				for(var i= (parent.children.length - 1); i>=0; i--){
					var child = parent.children[i];
					scaleBodyBones(parent.children[i],x,y,z);
					child.position.x = child.position.x*x;
					child.position.y = child.position.y*y;
					child.position.z = child.position.z*z;
					if (limbsArray.indexOf(child) > -1){
						parent.removeChild(child);
						scene.removeObject(child);
					}
				}
			}

			function removeLimbs(parent){
				for(var i= (parent.children.length - 1); i>=0; i--){
					var child = parent.children[i];
					removeLimbs(child);
					if (limbsArray.indexOf(child) > -1){
						parent.removeChild(child);
						scene.removeObject(child);
					}
				}
			}
			
			function swapArray(){
				//takes the PHP array and stores it into a javascript array.
				<?php 
					for($i = 0; $i < count($hmm); $i++)
					{
						echo "tester[$i]='".$hmm[$i]."';\n";
					}
				?>
			}

			function App( containerId, fullWidth, fullHeight, viewX, viewY, viewWidth, viewHeight) {	
				
				



			
				swapArray();
				//The 13, 14 and 15th items in the bvh file shows what order the rotation will be in
				rotationOrder[0] = tester[13].charAt(0);
				rotationOrder[1] = tester[14].charAt(0);
				rotationOrder[2] = tester[15].charAt(0);
				console.log(rotationOrder[0] + rotationOrder[1] + rotationOrder[2]);

				parseJoint(1, null);
				frameCount = tester[movementStart+1];
				fps = 1 / (tester[movementStart+4]*1);
				//frame time?	
				movementStart += 5;
				s = tester.length;
				
				//puts the movements into a seperate array.
				for(var j = movementStart; j < tester.length; j++)
				{
						movement[k] = tester[j] *1;
						k++;
				}
				
				function findJoint (joint){
					for(var i = 0; i<theBody.length; i++){
						if(joint.id == theBody[i].id){
							return theBody[i];
						}
					}
				}

				//Recursively parses joint information from the bvh file
				function parseJoint(startIndex, parent){
					jointIndices.push(startIndex);
					var joint = new THREE.Mesh(new THREE.SphereGeometry(2,20,20), legMaterial);
					theBody.push(joint);
					loc++;
					var i = startIndex+1;
					for(i; i < tester.length; i++){
						var token = tester[i];
						if(isNaN(token)){
							if(token == '{'){
								oBracket++;
							}
							else if(token == '}'){
								cBracket++;
								if(startIndex != 1){
									return i-startIndex;
								}
							}
							else if(token == 'OFFSET'){
								joint.position.x = tester[i+1]*1;
								joint.position.y = tester[i+2]*1;
								joint.position.z = tester[i+3]*1;

								if(parent != null){
									var bodyParent = findJoint(parent);
									parent.addChild(joint);
								}
								
							}
							else if(token == 'CHANNELS'){
								
								jointChannels.push(tester[i+1]); 
							}
							else if(token == 'JOINT'){
								i += parseJoint(i, joint);
							}
							else if(token == 'End'){
								noMovement[ender] = loc - 1;
								ender++;
								i += parseJoint(i, joint);
							}
							else if(token == 'MOTION'){
								movementStart = i+1;
								return;
							}
						}
					}
				}
				
				
				
	 			initialize();
				animate();
	 			//sets up the scene.
				function initialize() {
	 
	 				//here we are setting a container to put the webgl scene in. You initalize paramters in 
					//css at the top and then place the scene into that container here.
					
					var container = document.getElementById( containerId );
	 
	 				//trackball camera -> extremely useful 
					//I added small changes to the code so you must press ALT to make it work.
					camera = new THREE.TrackballCamera({ 
						
						//all the parameters you can tweak to get desired result.
						fov: 60, 
						aspect: 800 / 500,
						near: 1,
						far: 1e7,
					
					
						domElement: container,
						rotateSpeed: .8,
						zoomSpeed: 1.4,
						panSpeed: 0.8,

						noZoom: false,
						noPan: false,

						staticMoving: true,
						dynamicDampingFactor: 0.3,

			
					});
			
					//screen.width = container.clientWidth;
					//screen.height = container.clientHeight;
	 				camera.position.z = 100;
	 				camera.position.y = 100;
	 				camera.position.x = -200;

					//setting and adding the skeleton we made to the scene.
					scene = new THREE.Scene();
					scene.addObject( theBody[0] );
					
					//EULER ORDER -TESTING
					for(var i=0; i<theBody.length; i++){
						theBody[i].eulerOrder = rotationOrder[0]+rotationOrder[1]+rotationOrder[2];
						//console.log(theBody[i].eulerOrder);
					}
					//make all the ghost spheres and limbs and store them in a double array.

					//here we initalize a renderer, rendering in WebGL allows us to use 3D
					renderer = new THREE.WebGLRenderer();
					renderer.setSize( container.clientWidth, container.clientHeight );
					container.appendChild( renderer.domElement );
					
									
					//since we are only given the positions of the spheres, this method will draw the limbs to connect them.					
					drawLimbs(theBody, 0, false);	
					//Automatically scale bones up is max bone length is less than 5.
					if (maxLimb < 5){
						scaleBones(25/maxLimb, 25/maxLimb, 25/maxLimb);
					}
					//Auto set bounding box
					var boundingbox = getBoundingBox(theBody[0]);
					console.log(boundingbox);
					var xlen = boundingbox.max.x - boundingbox.min.x;
					var ylen = boundingbox.max.y - boundingbox.min.y;
					var zlen = boundingbox.max.z - boundingbox.min.z;
					//var maxlen = Math.max(xlen,ylen,zlen);
					var maxlen = Math.max(xlen,ylen);
					if (maxlen == xlen){
						console.log("X");
						setUpVector(1,0,0);
					}
					else if (maxlen == ylen){
						console.log("Y");
						setUpVector(0,1,0);
					}
					else if (maxlen == zlen){
						console.log("Z");
						setUpVector(0,0,1);
					}
					console.log(Math.max(xlen,ylen,zlen));

					//drawAllLimbs(theBody[0]);	
						
	                //Draw the bottom grid
	                var geometry = new THREE.Geometry();
	                geometry.vertices.push( new THREE.Vertex( new THREE.Vector3( - 500, 0, 0 ) ) );
	                geometry.vertices.push( new THREE.Vertex( new THREE.Vector3( 500, 0, 0 ) ) );
	                material = new THREE.LineBasicMaterial( { color: 0xffffff, opacity: 0.3 } );
	        
	                for ( var i = 0; i <= 10; i ++ ) 
					{
	        
	                    var line = new THREE.Line( geometry, material );
	                    line.position.y = 0;
	                    line.position.z = ( i * 100 ) - 500;
	                    scene.addObject( line );
					
	        
	                    var line = new THREE.Line( geometry, material );
	                    line.position.x = ( i * 100 ) - 500;
	                    line.position.y = 0;
	                    line.rotation.y = 90 * Math.PI / 180;
	                    scene.addObject( line );
					
	        
	                 }
					 
					 
					 
					  stats = new Stats();
	 				  stats.domElement.style.position = 'absolute';
	 				  stats.domElement.style.top = '0px';
					  
	 				  container.appendChild( stats.domElement );
					  
									
				}
	 
				
				
				//this is so we know how many numbers there will be for each frame.
				tracker = ((theBody.length-noMovement.length) *3) + 6;
				gcount = 0;
				k = 0;	 
				offset = 0;
				
			}

		//function to draw the limbs.
		//num is only used for the ghost array.
		//double determines whether this is a doubleArray
		function drawLimbs(theArray, num, double)
				{
					var joint1, joint2, tempX, tempY, tempZ, theLimb, rotX, rotY, rotZ, distance;
					var sphereMaterial = new THREE.MeshLambertMaterial({color: 0xCC0000});
					if(double){
						sphereMaterial.opacity = 0.5;
					}
					var placementX, placementY,placementZ;
					var placementArray= new Array();
					
						
					//clones the array so its passed by value, not by reference
					for(var world = 0; world < theBody.length; world++)
					{
						theWorldBody[world] = (new THREE.Vertex((theBody[world].position.clone())));
						placementArray[world] = (new THREE.Vertex((theBody[world].position.clone())));
					}

					var worldLen = theWorldBody.length;

					//this loop keeps track of the world positions.
					for(var world2 = 1; world2 < worldLen; world2++)
					{
						var bodyWorld2 = theWorldBody[world2];
						var bodyPrev = theWorldBody[world2-1];
						//if the parent is the previous location, just take the current local position of 
						//the sphere and add it to the previous's world position.
						if(theBody[world2].parent == theBody[world2-1])
							{
								bodyWorld2.position.x += (bodyPrev.position.x);
								bodyWorld2.position.y += (bodyPrev.position.y);
								bodyWorld2.position.z += (bodyPrev.position.z);
							}
							else 
							{
								//if not we have to find the parent. and add the current local position to it's 
								//parent's world position
								for(var r = 0; r < worldLen; r++)
								{

									if(theBody[world2].parent == theBody[r])
									{
										var parentWorld = theWorldBody[r];
										bodyWorld2.position.x += (parentWorld.position.x);
										bodyWorld2.position.y += (parentWorld.position.y);
										bodyWorld2.position.z += (parentWorld.position.z);
										//if we find it then we can exit the loop.
										r = theWorldBody.length;
										
									}
								}
								
								
							}
							
					}
					
					//here is where the calculations are done to find the correct position, length, and rotation of the cylinder limb.
					var placer, other= 0;
					for(var i = 1; i < worldLen; i++)
					{
						//if the parent is the previous object in array, use these positons
					   	if(theBody[i].parent == theBody[i-1])
					   	{
							placer = i-1;
							other = i;
					   	}
					  	
						else
						{	
							//if not we have to find teh parent's position.
							for(var r = 0; r < worldLen; r++){
									if(theBody[i].parent == theBody[r])
									{

										placer = r;
										other = i;
										//exit the loop
										r = theWorldBody.length;
										
								     }
							}
		
						}
					   			
			   			//keep track of lengths.		
						var v1 = new THREE.Vector3(theWorldBody[placer].position.x, theWorldBody[placer].position.y, theWorldBody[placer].position.z);
						var v2 = new THREE.Vector3(theWorldBody[other].position.x, theWorldBody[other].position.y, theWorldBody[other].position.z);
						var v3 = new THREE.Vector3(v1.x-v2.x, v1.y - v2.y, v1.z - v2.z); //to find the length
						var v4 = new THREE.Vector3(0, 0, 1); //the axis vector
							
						placementX = placementArray[other].position.x;
						placementY = placementArray[other].position.y;
						placementZ = placementArray[other].position.z;	
						
						if(v3.length() > maxLimb){
							maxLimb = v3.length();
						}
						//new cylinder object
						var boneThickness = 1.5;
			   			theLimb = new THREE.Mesh( new THREE.CylinderGeometry( 30, boneThickness, boneThickness, v3.length() -2 , 1, 1), sphereMaterial );
						
						//keeps track of where to place the limb.
						placementX /= 2;
						placementY /= 2;
						placementZ /= 2;	
					
						//calculations with quaternions for rotation
						v4.normalize();
						v3.normalize();
						var crossVecs = new THREE.Vector3();
						crossVecs.cross(v4,v3);
						crossVecs.normalize();

						var dotVecs = Math.acos(v3.dot(v4)/(v3.length()*v4.length()));

						q1 = new THREE.Quaternion();
						q1.setFromAxisAngle(crossVecs, dotVecs);
						q1.normalize();

						if(distance !=0)
						{
					
							theLimb.useQuaternion = true;
							theLimb.quaternion = q1;

						}
						//sets the position and adds the object to the parent
						theLimb.position.x = placementX;
						theLimb.position.y = placementY;
						theLimb.position.z = placementZ;
						
						if(double){
							theArray[num][placer].addChild(theLimb);
						}
						else{
							theArray[placer].addChild(theLimb);
							
						}	
						limbsArray.push(theLimb);	

					}	
				}

		//Animates one frame forward
		function animateFrame(){

					
					
					for(var joint = 0; joint < theBody.length; joint++)
					{
						
						
						for(var theEnd = 0; theEnd < noMovement.length; theEnd++)
						{
							//if it is an end joint it does not rotate, so we skip it.
							if(joint == noMovement[theEnd])
							{
								//console.log(theJoint.rotation);
								joint++;
							}
						}
						
						if (joint >= theBody.length){
								break;
						}

						var theJoint = theBody[joint];
						//if it is the root it has rotations and positions. we handle this seperately.
						if(joint == 0)
						{
						
							theJoint.position.x = movement[offset++];
							theJoint.position.z = -movement[offset++];
							theJoint.position.y = movement[offset++];

							
							for(var i = 0; i < 3; i++){
								if(rotationOrder[i] === "X"){
									theJoint.rotation.x = Math.PI/180 * movement[offset++] + Math.PI /180 * -90;
								}
								else if(rotationOrder[i] === "Y"){
									theJoint.rotation.y = Math.PI/180 * movement[offset++] ;
								}
								else if(rotationOrder[i] === "Z"){
									theJoint.rotation.z = Math.PI/180 * movement[offset++];
								}
							}
						}
				
						//if it's not the root it has three rotations like everything else.
						else
						{	
							if (jointChannels[joint] == 6){
								//theJoint.position.x = movement[offset++];
								//theJoint.position.z = -movement[offset++];
								//theJoint.position.y = movement[offset++];
								
								
								offset+=3;
							}

							for(var i = 0; i < 3; i++){
								if(rotationOrder[i] === "X"){
									theJoint.rotation.x = movement[offset++] * Math.PI/180;
								}
								else if(rotationOrder[i] === "Y"){
									theJoint.rotation.y = movement[offset++] * Math.PI/180;
								}
								else if(rotationOrder[i] === "Z"){
									theJoint.rotation.z = movement[offset++] * Math.PI/180;
								}
							}
							
							
							
						}
						
					}
					if(k % 100 == 0 && k > 99){
						//Create a ghost body that's the copy of the actual body
						//at this frame
						if(ghostArray[gcount] == null){
							var geometry = theBody[0].geometry;
							var ghostMaterial = new THREE.MeshLambertMaterial({color: 0x6666FF, opacity:0.5});
							var pos = theBody[0].position;
							var children = theBody[0].children;
							var rot = theBody[0].rotation;
							var ghost = new THREE.Mesh(geometry,ghostMaterial);
							ghost.eulerOrder = theBody[0].eulerOrder;
							ghost.position.set(pos.x, pos.y, pos.z);
							ghost.rotation.set(rot.x,rot.y,rot.z);
							createGhost(theBody[0], ghost);

							ghostArray[gcount] = new Array(30);
							ghostArray[gcount][0] = ghost;
						}
						
						//If trace is toggled on, add all ghost bodies to the scene
						if(traceOn)
						{	
							scene.addObject(ghostArray[gcount][0]);
						}
						gcount++;
					}
					//removeLimbs(theBody[0]);
					//drawLimbs(theBody, 1, false);
					//calls render function	
					render();	
					//k++;

					//Recursively reates a ghost body that is the copy of
					//the actual body at that frame
					function createGhost(worldparent, ghostparent){
						var children = worldparent.children;
						for(var i=0; i<children.length; i++){
							var child = children[i];
							geometry = child.geometry;
							pos = child.position;
							
							var ghostjoint;

							if (limbsArray.indexOf(child) > -1){
								ghostjoint = new THREE.Mesh(geometry, ghostLimbMaterial);
								limbsArray.push(ghostjoint);
								ghostjoint.useQuaternion = true;
								ghostjoint.quaternion = child.quaternion;
							}
							else{
								ghostjoint = new THREE.Mesh(geometry, ghostMaterial);
							}
							ghostjoint.eulerOrder = child.eulerOrder;
							ghostjoint.position.set(pos.x, pos.y, pos.z);
							rot = child.rotation;
							ghostjoint.rotation.set(rot.x,rot.y,rot.z);
							ghostparent.addChild(ghostjoint);
							createGhost(children[i], ghostjoint);

						}	
					}
		}


		//Animates one frame back
		function animateFrameBack(){
			console.log(this);
			offset--;
			for(var joint = theBody.length - 1; joint >= 0; joint--)
					{
						
						
						for(var theEnd = noMovement.length-1; theEnd >= 0; theEnd--)
						{
							//if it is an end joint it does not rotate, so we skip it.
							if(joint == noMovement[theEnd])
							{
								joint--;
								break;
							}
						}
						
						if (joint < 0){
								break;
						}
						var theJoint = theBody[joint];
						
						//if it is the root it has rotations and positions. we handle this seperately.
						if(joint == 0)
						{
							for(var i = 2; i >= 0; i--){
								if(rotationOrder[i] === "X"){
									theJoint.rotation.x = Math.PI/180 * movement[offset--] + Math.PI /180 * -90;
								}
								else if(rotationOrder[i] === "Y"){
									theJoint.rotation.y = Math.PI/180 * movement[offset--] ;
								}
								else if(rotationOrder[i] === "Z"){
									theJoint.rotation.z = Math.PI/180 * movement[offset--];
								}
							}

							theJoint.position.y = movement[offset--];
							theJoint.position.z = -movement[offset--];
							theJoint.position.x = movement[offset--];
							
						}
				
						//if it's not the root it has three rotations like everything else.
						else
						{	
							for(var i = 2; i >= 0; i--){
								if(rotationOrder[i] === "X"){
									theJoint.rotation.x = movement[offset--] * Math.PI/180;
								}
								else if(rotationOrder[i] === "Y"){
									theJoint.rotation.y = movement[offset--] * Math.PI/180;
								}
								else if(rotationOrder[i] === "Z"){
									theJoint.rotation.z = movement[offset--] * Math.PI/180;
								}
							}

							if (jointChannels[joint] == 6){
								//theJoint.position.x = movement[offset++];
								//theJoint.position.z = -movement[offset++];
								//theJoint.position.y = movement[offset++];

								offset-=3;
							}

						}
						
					}
					offset++;
					render();
		}
		//handles the animation
		function animate() {

			//Set the frame rate to the value found in the bvh file
			//Remove the setTimeout bit if you just want 60 fps
			setTimeout( function() {
				
			requestAnimationFrame( animate );

			}, 1000/fps);
			
			
			if(!paused){
				//frame count is found in the file that we read in.
				if(k < frameCount){
					
					animateFrame();
					k++;
				
					
				}
				//if the animation is done, and we ran out of frames. render it as it ended.
				else { 

					render();
				}
			}
		}

		//gets the bounding box of the object --> the minimum point and maximum point
		function getBoundingBox(object){
			var bounds = {
			    min: new THREE.Vector3(Infinity, Infinity, Infinity),
			    max: new THREE.Vector3(-Infinity, -Infinity, -Infinity)
			}
			for(var i=0; i<theBody.length; i++){
				var joint = theBody[i];
		    	console.log(joint.__proto__);
		        var worldMax = joint..localToWorld(joint.position);
		        var worldMin = joint.__proto__.localToWorld(joint.position);

		        bounds.min.x = Math.min(bounds.min.x, worldMin.x);
		        bounds.min.y = Math.min(bounds.min.y, worldMin.y);
		        bounds.min.z = Math.min(bounds.min.z, worldMin.z);

		        bounds.max.x = Math.max(bounds.max.x, worldMax.x);
		        bounds.max.y = Math.max(bounds.max.y, worldMax.y);
		        bounds.max.z = Math.max(bounds.max.z, worldMax.z);
			    
			}
			return bounds;
		}
		//render function
		function render() 
		{
				renderer.render(scene, camera);
				stats.update();
		}
		</script>
	</body> 
</html> 