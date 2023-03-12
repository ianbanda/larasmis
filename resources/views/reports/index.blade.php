@extends('main')
@section('title', 'Reports')
@section('content')
<div class="w3-row">
    <div style="margin-left: auto;margin-right:auto; width:90%;">
        <h2 class="redfont w3-margin-top"><b>REPORTS</b></h2>
        <div class="redfont"  style="font-weight:bold">
            <div class="w3-third">
                <div class="w3-card w3-white">
                    <img src="Resources/Images/report.png" class="w3-margin" style="width:10%;">
                    <div class="w3-container">
                        <p><a href="#" onclick="reports.tabClicked('academic')">ACADEMIC</a></p>
                    </div>
                </div>
            </div>
            <div class="w3-third w3-white">
                <div class="w3-card">
                    <img src="Resources/Images/discipline.png" class="w3-margin" style="width:10%;">
                    <div class="w3-container">
                        <p><a href="#">DISCIPLINE</a></p>
                    </div>
                </div>
            </div>
            <div class="w3-third w3-white">
                <div class="w3-card">
                    <img src="Resources/Images/registration.png" class="w3-margin" style="width:10%;">
                    <div class="w3-container">
                        <p><a href="#">ATTENDANCE</a></p>
                    </div>
                </div>
            </div>
        </div>
    <br/>
        <div id='tabContainer' class='w3-container w3-white w3-margin w3-card'>
            <h3 id='title' class="bluefont"><b>Academic</b></h3>
            <div id="container" class='w3-row w3-white w3-padding w3-white w3-margin-bottom w3-text-grey' style='max-height:200px;overflow-y:auto'>
                <!-- START homeclasslist -->
                <div class='w3-left w3-btn w3-padding w3-border w3-margin'>
                    <a href='reports/academic?type=eot' class='' style='text-decoration:none;'>
                        <h6 class='w3-border-bottom w3-large'>EOT</h6>
                        <div class='w3-tiny redfont'><b>End of Term Reports</b></div>
                    </a>
                </div>
                <!-- END homeclasslist -->
            </div>
        </div>


        <div class="w3-container w3-padding w3-white w3-margin w3-border">
            <h3 class='w3-border-bottom'>Modules</h3>
            <div class="w3-row">
                <div class="w3-left w3-btn w3-card redtheme w3-margin w3-round-xlarge">
                    <a href="registrations" style='text-decoration:none;'>Registration</a>
                </div>
                <div class="w3-left w3-btn w3-card redtheme w3-margin w3-round-xlarge">
                    <a href="timetables" style='text-decoration:none;'>Timetables</a>
                </div>
                <div class="w3-left w3-btn w3-card redtheme w3-margin w3-round-xlarge">
                    <a href="lessonmanagement" style='text-decoration:none;'>Lesson Management</a>
                </div>
                <div class="w3-left w3-btn w3-card redtheme w3-margin w3-round-xlarge">
                    <a href="academics/exams" style='text-decoration:none;'>Exams and Tests</a>
                </div>
                <div class="w3-left w3-btn w3-card redtheme w3-margin w3-round-xlarge">
                    <a href="reports" style='text-decoration:none;'>Reports</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection