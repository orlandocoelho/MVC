<?php $cat = $_GET['cat'];?>
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#prestige">
          Linha Prestige
        </a>
      </h4>
    </div>
    <div id="prestige" class="panel-collapse collapse <? if($cat == 'prestige') {echo 'in'} ?>">
      <div class="panel-body">
      	<ul class="nav nav-pills nav-stacked">
			<li><a href="?cat=prestige&sub=II">Prestige II</a></li>
			<li><a href="?cat=prestige&sub=II CV">Prestige II CV</a></li>
			<li><a href="?cat=prestige&sub=III">Prestige III</a></li>
			<li><a href="?cat=prestige&sub=III CV">Prestige III CV</a></li>
		</ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#atlantic">
          Linha Atlantic
        </a>
      </h4>
    </div>
    <div id="atlantic" class="panel-collapse collapse <? if ($cat == 'atlantic') {echo 'in';} ?>">
      <div class="panel-body">
      	<ul class="nav nav-pills nav-stacked">
			<li><a href="?cat=atlantic&sub=I">Atlantic I</a></li>
			<li><a href="?cat=atlantic&sub=I CV">Atlantic I CV</a></li>
			<li><a href="?cat=atlantic&sub=II">Atlantic II</a></li>
			<li><a href="?cat=atlantic&sub=II CV">Atlantic II CV</a></li>
			<li><a href="?cat=atlantic&sub=II Compact">Atlantic II Compact</a></li>
			<li><a href="?cat=atlantic&sub=II CV Compact">Atlantic II CV Compact</a></li>
			<li><a href="?cat=atlantic&sub=II Tall Cups">Atlantic II Tall Cups</a></li>
			<li><a href="?cat=atlantic&sub=II CV Tall Cups">Atlantic II CV Tall Cups</a></li>
		</ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#semi">
          Linha Semi Profissional
        </a>
      </h4>
    </div>
    <div id="semi" class="panel-collapse collapse <? if ($cat == 'semi') {echo 'in';} ?>">
      <div class="panel-body">
		<ul class="nav nav-pills nav-stacked">
			<li><a href="?cat=semi&sub=Mini Bar">Mini Bar</a></li>
			<li><a href="?cat=semi&sub=Marina">Marina</a></li>
			<li><a href="?cat=semi&sub=Marina CV">Marina CV</a></li>
		</ul>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#automatica">
          Linha Automática
        </a>
      </h4>
    </div>
    <div id="automatica" class="panel-collapse collapse <? if ($cat == 'automatica') {echo 'in';} ?>">
      <div class="panel-body">
		<ul class="nav nav-pills nav-stacked">
			<li><a href="?cat=automatica&sub=Advanced I">Advanced I</a></li>
		</ul>
      </div>
    </div>
  </div>

</div>