jQuery(function() {
    
  var animList = ["FromTopShort", "FromBottomShort", "FromLeftShort", "FromRightShort", "FromTopLong", "FromBottomLong", "FromLeftLong", "FromRightLong", "FadeIn", "FadeOut", "Rotate", "Rotate2", "Vibration", "Vibration2"];

  for (a in animList)
  { 
      var el = "." + animList[a];
      jQuery(el).css("opacity", 0);

      jQuery(el).waypoint(function() {

          var cx = jQuery(this);

          var thisAnimation = 0;

          for (cc in animList)
          {
             if (cx.hasClass(animList[cc]))
             {
                thisAnimation = animList[cc];
             }
          }

          new Animo({
            el: cx,
            duration: 600,  
            gap: 80,
            template: animo.Template[thisAnimation.replace(".", "")]
          }); // animo

       },
       {
          triggerOnce: true,
          continous: true,
           offset: '80%'
         
      });
		  
  } // lpop



  
}); // jquery


//From Top,Bottom
animo.Template.FromTopShort = {
	  opacity: [0, 1],
      "margin-top": [-100, 0, "px"]
},
animo.Template.FromBottomShort = {
	  opacity: [0, 1],
      "margin-top": [100, 0, "px"]
},
animo.Template.FromLeftShort = {
  opacity: [0, 1],
  "margin-left": [-100, 0, "px"]
},
animo.Template.FromRightShort = {
	  opacity: [0, 1],
      "margin-left": [100, 0, "px"]
},
animo.Template.FromTopLong = {
	  opacity: [0, 1],
      "margin-top": [-250, 0, "px"]
},
animo.Template.FromBottomLong = {
	  opacity: [0, 1],
    "margin-top": [250, 0, "px"]
},
animo.Template.FromLeftLong = {
	  opacity: [0, 1],
      "margin-left": [-250, 0, "px"]
},
animo.Template.FromRightLong = {
	  opacity: [0, 1],
      "margin-left": [250, 0, "px"]
},
//Fade Animations	
animo.Template.FadeIn = {
   scale: [2, 1],
   opacity: [0, 1]
},
animo.Template.FadeOut = {
   scale: [0, 1],
   opacity: [0, 1]
},
//Rotate Animation
animo.Template.Rotate = {
	opacity: [0, 1],
    scale: [1.5, 1],
    rotateX: [240, 0, "deg"]
},
animo.Template.Rotate2 = {
  opacity: [0, 1],
  scale: [0, 1],
  rotate: [-90, 0, "deg"]
},
//Vibration Animation
animo.Template.Vibration = {
 opacity: [0, 1],
 translateY: [-100, 0, "%"]
},
animo.Template.Vibration2 = {
 opacity: [0, 1],
 translateY: [100, 0, "%"]
}

