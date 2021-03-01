<?php

 #
 # nvr - System information app
 #
 # info: main folder copyright file
 #
 #



function liveview(){
  global $L_LIVE_VIEW;

?>

  <style>
    img {
      max-width: 100%;
      max-height: 100%;
      height: auto;
    }
    .border {
      border-width: 2px;
      border-color: white;
      border-style: solid;
    }
  </style>


  <div id="id_header">
    <h3 id='h3_cam' data-cam="cam_all00" class='center'><?php echo($L_LIVE_VIEW); ?></h3>
  </div>

  <div id='cfg_form' style="display:none">
    <h4 id='h4_parm' class='header-center'>webcontrol_parms = 0 (No Configuration Options)</h4>
    <form class="frm-input">
      <select id='cfg_parms' name='onames'  autocomplete='off' onchange='config_change();'>
        <option value='default' data-cam_all00="" >Select option</option>
      </select>
      <input type="text"   id="cfg_value" >
      <input type='button' id='cfg_button' value='Save' onclick='config_click()'>
    </form>
  </div>
  <div id='trk_form' style='display:none'>
    <form class='frm-input'>
      <select id='trk_option' name='trkopt'  autocomplete='off'  style='width:20%' onchange='track_change();'>
        <option value='pan/tilt' data-trk='pan' >Pan/Tilt</option>
        <option value='absolute' data-trk='abs' >Absolute Change</option>
        <option value='center' data-trk='ctr' >Center</option>
      </select>
      <label id='trk_lblpan' style='color:white; display:inline' >Pan</label>
      <label id='trk_lblx'   style='color:white; display:none' >X</label>
      <input type='text'   id='trk_panx' style='width:10%' >
      <label id='trk_lbltilt' style='color:white; display:inline' >Tilt</label>
      <label id='trk_lbly'   style='color:white; display:none' >Y</label>
      <input type='text'   id='trk_tilty' style='width:10%' >
      <input type='button' id='trk_button' value='Save'  style='width:10%' onclick='track_click()'>
    </form>
  </div>
  <div id="liveview">
    <section class="main-content">
      <br>
      <p id="id_preview">
      <a href=http://192.168.10.200:8081/1/stream>  <img src=http://192.168.10.200:8081/1/stream border=0 width=25%></a>
      <a href=http://192.168.10.200:8081/2/stream>  <img src=http://192.168.10.200:8081/2/stream border=0 width=25%></a>
      <a href=http://192.168.10.200:8081/3/stream>  <img src=http://192.168.10.200:8081/3/stream border=0 width=25%></a>
      </p>
      <br>
    </section>
  </div>

  <script>
    function event_reloadpage() {
      window.location.reload();
    }

    function camera_click(camid) {
      var preview = "";
      var header = "";
      if (camid == "cam_00001"){
        preview="<a href=http://192.168.10.200:8081/1/stream>  <img src=http://192.168.10.200:8081/1/stream/ border=0 width=95%></a>"  
        header="<h3 id='h3_cam' data-cam='" + camid + "'  class='header-center' >Nappali (Active)</h3>"
      }
      if (camid == "cam_00002"){
        preview="<a href=http://192.168.10.200:8081/2/stream>  <img src=http://192.168.10.200:8081/2/stream/ border=0 width=95%></a>"  
        header="<h3 id='h3_cam' data-cam='" + camid + "'  class='header-center' >Konyha (Active)</h3>"
      }
      if (camid == "cam_00003"){
        preview="<a href=http://192.168.10.200:8081/3/stream>  <img src=http://192.168.10.200:8081/3/stream/ border=0 width=95%></a>"  
        header="<h3 id='h3_cam' data-cam='" + camid + "'  class='header-center' >ElÅ‘szoba (Active)</h3>"
      }
      if (camid == "cam_all00"){
        preview = "";
        preview = preview + "<a href=http://192.168.10.200:8081/1/stream>  <img src=http://192.168.10.200:8081/1/stream border=0 width=25%></a>"; 
        preview = preview + "<a href=http://192.168.10.200:8081/2/stream>  <img src=http://192.168.10.200:8081/2/stream border=0 width=25%></a>"; 
        preview = preview + "<a href=http://192.168.10.200:8081/3/stream>  <img src=http://192.168.10.200:8081/3/stream border=0 width=25%></a>"; 
        header="<h3 id='h3_cam' data-cam='" + camid + "'  class='header-center' >All Cameras</h3>"
      }
      document.getElementById("id_preview").innerHTML = preview; 
      document.getElementById("id_header").innerHTML = header; 
      document.getElementById('cfg_form').style.display="none"; 
      document.getElementById('trk_form').style.display="none"; 
      document.getElementById('cam_btn').style.display="none"; 
      document.getElementById('cfg_value').value = '';
      document.getElementById('cfg_parms').value = 'default';
    }

    function display_cameras() {
      document.getElementById('act_btn').style.display = 'none';
      if (document.getElementById('cam_btn').style.display == 'block'){
        document.getElementById('cam_btn').style.display = 'none';
      } else {
        document.getElementById('cam_btn').style.display = 'block';
      }
    }
 
    function display_actions() {
      document.getElementById('cam_btn').style.display = 'none';
      if (document.getElementById('act_btn').style.display == 'block'){
        document.getElementById('act_btn').style.display = 'none';
      } else {
        document.getElementById('act_btn').style.display = 'block';
      }
    }

    document.addEventListener('click', function(event) {
      const dropCam = document.getElementById('cam_drop');
      const dropAct = document.getElementById('act_drop');
      if (!dropCam.contains(event.target) && !dropAct.contains(event.target)) {
        document.getElementById('cam_btn').style.display = 'none';
        document.getElementById('act_btn').style.display = 'none';
      }
    });
 
  </script>

<?php


}


?>
