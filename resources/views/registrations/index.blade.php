@extends('main')
@section('title', 'Registrations')
@section('content')
<div class="w3-row">
    <div style="margin-left: auto;margin-right:auto; width:90%;">
        <h2 class="redfont w3-margin-top"><b>Attendance Registrations</b></h2>
        
    <br/>
        


        <div class="w3-container w3-padding w3-white w3-margin">
            <h3 class='w3-border-bottom bluefont'><b>Registrations</b></h3>
            <div class="w3-row">
                <div class="w3-left w3-btn w3-card w3-white w3-margin w3-round-xlarge">
                    <a href="#" onclick="attendance.showClassAttencanceModal(1,'Daily')" style='text-decoration:none;'>Daily Attendance Registration</a>
                </div>
                <div class="w3-left w3-btn w3-card w3-white w3-margin w3-round-xlarge">
                    <a href="registration" style='text-decoration:none;'>Exam Attendance Registration</a>
                </div>
                <div class="w3-left w3-btn w3-card w3-white w3-margin w3-round-xlarge">
                    <a href="registration" style='text-decoration:none;'>Lesson Attendance</a>
                </div>
                <div class="w3-left w3-btn w3-card w3-white w3-border redborder w3-margin w3-round-xlarge">
                    <a href="academics" style='text-decoration:none;'>Reports & Summmaries</a>
                </div>
            </div>
        </div>

        <div class="w3-container w3-white w3-margin">
            <div class="w3-row w3-margin-top w3-large w3-border-bottom w3-padding bluefont">
                <b>Date<input id="attendanceDate" value="{date}" class="w3-margin-left bluetheme w3-btn w3-round-large w3-small w3-padding" type="date" /><b>
            </div>

            <div class="w3-white w3-row" style="padding: 10px">
               <div class="w3-half">
                   <h4 class="redfont">Daily Attendance Summary</h4>
                   <div class="w3-row stats"></div>
                   <div class="w3-row">
                    <div class="w3-left w3-half">
                            <b>Completed</b>
                            <ul class="w3-ul ">
                                <!-- START dacclasslist -->
                                <li class="w3-row ">
                                    <div class="w3-left w3-tiny w3-margin-right w3-card w3-round-large w3-padding w3-border redborder">11C</div>
                                    <div class="w3-left w3-tiny">
                                        <div class="w3-text-grey">Person(s) Responsible</div>
                                        {form_teachers}
                                    </div>
                                </li>
                                <!-- END dacclasslist -->
                            </ul>
                    </div>
                    <div class="w3-left w3-half">
                        <b>Not Completed</b>
                        <ul class="w3-ul ">
                            <!-- START dancclasslist -->
                            <li class="w3-row ">
                                <div class="w3-left w3-tiny w3-margin-right w3-round-large w3-card redtheme w3-padding">{abbr}</div>
                                <div class="w3-left w3-tiny">
                                    <div class="w3-text-grey">Person(s) Responsible</div>
                                    {form_teachers}
                                </div>
                            </li>
                            <!-- END dancclasslist -->
                        </ul>
                    </div>
                   </div>
               </div>
               <div class="w3-half ">
                   <h4 class="redfont">Lesson/Period Attendance Summary</h4>
                   <div class="w3-row stats"></div>
                   <div class="w3-row">
                    <div class="w3-left w3-half">
                        <b>Completed</b>
                        <ul class="w3-ul ">
                            <!-- START pacclasslist -->
                            <li class="w3-row ">
                                <div class="w3-left w3-tiny w3-margin-right w3-card w3-round-large w3-padding">11C</div>
                                <div class="w3-left w3-tiny">
                                    <div class="w3-text-grey">Person(s) Responsible</div>
                                    {form_teachers}
                                </div>
                            </li>
                            <!-- END pacclasslist -->
                        </ul>
                    </div>
                    <div class="w3-left w3-half">
                        <b>Not Completed</b>
                        <ul class="w3-ul ">
                            <!-- START pancclasslist -->
                            <li class="w3-row ">
                                <div class="w3-left w3-tiny w3-margin-right  w3-card w3-round-large redtheme w3-padding">11C</div>
                                <div class="w3-left w3-tiny">
                                    <div class="w3-text-grey">Person(s) Responsible</div>
                                    {form_teachers}
                                </div>
                            </li>
                            <!-- END pancclasslist -->
                        </ul>
                    </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>

<!-- Take Registration Modal -->
<div id="takeRegModal" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('takeRegModal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <div id='classAttModalCont'>
          <h3 id="takeRegModalTitle" class="redfont w3-border-bottom"><b>Take Registration</b></h3>
          
        <div id="takeRegModalBody" class='w3-row'>
            <div class='w3-row w3-margin '>
                <!-- START takeregclasslist -->
                <a href="{bits}classes/view?classid={ID}&initAction=TakeAttendance" class="w3-left w3-card w3-btn w3-margin-right w3-margin-bottom">
                    {name}
                </a>
                <!-- END takeregclasslist -->
            </div>
            
        </div>
      </div>
    </div>
  </div>
</div>
@endsection