@extends('main')
@section('title', 'Timetables')
@section('content')
<div class=" exams" style="width:80%;margin:auto">
    <div class="w3-text-white">
        <h1 class="w3-margin w3-row">
            <b><span class="w3-left redfont pagetitle">Teaching Timetables</span></b>
            <a href='{bits}timetables/assignperiods?type=teaching' class="w3-btn w3-border-red w3-border w3-card w3-small w3-white w3-margin w3-round-large w3-right"  onclick="">Class Timetables</a>
            <button class="w3-btn w3-small redtheme w3-card w3-margin w3-round-large w3-right"  onclick="document.getElementById('newTimeTablePromptModal').style.display='block'">+ Create New</button>
        </h1>
    </div>
    <div class="">
    </div>
         
    <div class="w3-container w3-row">
        <div class="w3-half">
            <h3 class="w3-row w3-margin-top  w3-padding w3-text-red">
                <b class="bluefont">Timetable Type</b>
                <select class="w3-text-red w3-select w3-small" id="homeTTSelect"  name="homeTTSelect" onchange="general.selectChanged();$('.pagetitle').html($('#homeTTSelect option:selected').html()+'  Timetables')">
                    <!-- START tttypelist -->
                    <option value='{ID}'>{name}</option>
                    <!-- END tttypelist -->
                </select>
                
            </h3>
        </div>
        <div class="w3-half">
            <h3 class="w3-row w3-margin-top  w3-padding w3-text-red">
                <b class="bluefont">Class</b>
                <select class="w3-text-red w3-select w3-small" id="selectTTClass"  name="selectTTClass" onchange='general.selectChanged()'>
                    <option value='0'>All Classes</option>
                    <!-- START classlist --> 
                    <option value='{ID}'>{name}</option>
                    <!-- END classlist -->
                </select>
                
            </h3>
        </div>
        
        <h3 id="tterror" class="redfont w3-center" style="display:none">--</h3>

        <div  id='periodlistlarge' class="w3-white w3-row" style="padding: 10px">
            <!-- START daysofthisweek -->
            <div style="width: 13%;margin-right: 3px;" class="w3-left w3-border w3-hide-small w3-center">
                <h5 class="w3-margin-left w3-hide-small">{day}
                    <br><span class="w3-text-blue" style="font-size: 10px">{date}</span>
                </h5>
                <div class='dayperiods' day='{day}'>
                    <!-- START {day}periods -->
                    
                    <button  id='periodbtn{ID}'
                        onclick="timetables.assignTeacherToPeriodModal('{ID}','{day}')"
                        class="w3-margin-bottom w3-{teachercolor} w3-border w3-round-large w3-btn">
                        <div class="period  w3-hide-small  w3-margin-bottom  w3-center" style="margin: 3px;">
                            <div class="w3-small">
								
                                <div id='subjectp{ID}' class="w3-small">{subjectabbr}</div>
                                <div id='classp{ID}' class="">{classabbr}</div>
                                <div id='durationp{ID}' class="w3-tiny">{fstart} - {fend}</div>
                            </div>
                        </div>
                    </button>
                    
				<!-- END {day}periods -->
				</div>
			</div>
			<a id="{day}tt" href="#{day}ttcont" class="w3-hide-large w3-btn" onclick="$('.ttcont').hide();document.getElementById('{day}ttcont').style.display='block'" style="width: 100%">
				<div class="w3-row w3-light-gray w3-padding w3-small w3-hide-large w3-border-blue w3-margin-bottom" style="border-left: solid blue 3px;">
					<div class="w3-left">{day}</div>
					<div class="w3-right">{date}</div>
				</div>
			</a>
			<div class="w3-row ttcont w3-hide-large w3-margin-left" id="{day}ttcont" style="display: none;overflow-y: inherit; overflow-x: scroll;max-height: 80px;">
				<!-- START {day}speriods -->
				<div class="w3-left w3-border w3-margin-bottom w3-margin-right w3-hide-large">
					<button class="w3-btn w3-hover-light-blue" onclick="">
					<div class="w3-small" style="margin-right: 5px;padding: 5px;">
						<div class="w3-text-green w3-small">{subjectname}</div>
						<div class="w3-text-gray">{classname}</div>
					</div>
					</button>
				</div>
				<!-- END {day}speriods -->
			</div>
		<!-- END daysofthisweek -->
		</div>
	</div>
</div>

<!-- Modals ------------------------------------------------------------------------------>
        <!-- New Teaching Timetable Period Creation Prompt Modal -->
        <div id="periodCreationPromptModal" class="w3-modal">
            <div class="w3-modal-content w3-light-gray">
                <div class="w3-container">
                    <span onclick="document.getElementById('periodCreationPromptModal').style.display='none'"
                          class="w3-button w3-display-topright">&times;</span>
                          <div class="">
                              <div class="w3-text-grey">
                                  <h4>Period not yet created</h4>
                                  <h6 id='weekday' class='' term='{thisterm}'>{thisterm}</h6>
                              </div>
                              <div class='w3-white w3-margin w3-padding'>
                                  <div class="w3-margin">
                                      <h4 class='w3-text-grey'>A Lesson cannot be assigned to the timetable unless a period has been created.</h4>
                                      <h6>Would you like to create the period now?</h6>
                                        <div class="w3-light-gray w3-round w3-padding w3-border w3-row w3-center w3-margin-top w3-small w3-text-grey">
                                            <button
                                                onclick="timetables.addNewPeriodForm({weekday});document.getElementById('periodCreationPromptModal').style.display='none'"
                                                 class="w3-white w3-border w3-margin-right w3-border-red w3-padding w3-small w3-round-large">Yes</button>
                                
                                            <button
                                                onclick="document.getElementById('periodCreationPromptModal').style.display='none'"
                                                 class="w3-red w3-border w3-border-red w3-padding w3-small w3-round-large">No</button>
                                        </div>
                                      
                                  </div>
                              </div>
                              <div class="w3-row w3-margin-bottom">
                                  <button class='w3-btn w3-blue w3-right w3-margin-right' onclick='timetables.saveNewPeriodForm()'>Submit</button>
                              </div>
                          </div>
                </div>
            </div>
        </div>
        <!-- New Teaching Timetable Form Modal -->
        <div id="newTeachingTTFormModal" class="w3-modal">
            <div class="w3-modal-content w3-light-gray">
                <div class="w3-container">
                    <span onclick="document.getElementById('newTeachingTTFormModal').style.display='none'"
                          class="w3-button w3-display-topright">&times;</span>
                          <div class="">
                              <div class="w3-text-grey">
                                  <h2>Assign Period to Teacher</h2>
                                  <h6 id='weekday' class='' term='{thisterm}'>{thisterm}</h6>
                              </div>
                              <div class='w3-white w3-margin w3-padding'>
                                  <div class="w3-margin">
                                        <div id='assigperiod' name='' style="display:none">id</div>
                                        <div class="w3-light-gray w3-round w3-border w3-row w3-margin-top w3-small w3-text-grey">
                                            <table style='min-width:90%'>
                                                <tr>
                                                    <td width='30%'><b class="w3-margin-left">Teacher</b></td>
                                                    <td>
                                                        <select id='newTTPeriodTeacher' name='newTTPeriodTeacher' onchange='general.selectChanged()' class="w3-input w3-white w3-small" placeholder="0.0">
                                                            <option value='0' selected>
                                                                -- Select Teacher --
                                                            </option>
                                                            <!-- START ttteacherslist -->
                                                            <option value='{user_id}'>
                                                                {teachername}
                                                            </option>
                                                            <!-- END ttteacherslist -->
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="w3-light-gray w3-round w3-border w3-row w3-margin-top w3-small w3-text-grey">
                                            <table style='min-width:90%'>
                                                <tr>
                                                    <td width='30%'><b class="w3-margin-left">Class</b></td>
                                                    <td>
                                                        <select id='newTTPeriodClass' onchange='general.selectChanged()' name='newTTPeriodClass' class="w3-input w3-white w3-small" placeholder="0.0">
                                                            <!-- START ttclasslist --
                                                            <option value="{ID}">{name}</option>
                                                            <!-- END ttclasslist -->
															<option  value='0'>Select Teacher First</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="w3-light-gray w3-round w3-border w3-row w3-margin-top w3-small w3-text-grey">
                                            <table style='min-width:90%'>
                                                <tr>
                                                    <td width='30%'><b class="w3-margin-left">Subject</b></td>
                                                    <td>
                                                        <select id='newTTPeriodSub' name='newTTPeriodSub' class="w3-input w3-white w3-small" placeholder="0.0">
															<option value='0'>Select Class First</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        
                                        <div class="w3-light-gray w3-round w3-border w3-row w3-margin-top w3-small w3-text-grey">
                                            <table style='min-width:90%'>
                                                <tr>
                                                    <td width='30%'><b class="w3-margin-left">Time</b></td>
                                                    <td>
                                                        <div  id='newTTPeriodTime' class="w3-small">time</div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                      
                                  </div>
                              </div>
                              <div class="w3-row w3-margin-bottom">
                                  <button class='w3-btn w3-blue w3-right w3-margin-right' onclick='timetables.savePeriodToTeacher()'>Submit</button>
                              </div>
                          </div>
                </div>
            </div>
        </div>
        <!-- New Class Modal -->
        <div id="newTimeTablePromptModal" class="w3-modal">
            <div class="w3-modal-content w3-light-gray">
                <div class="w3-container">
                    <span onclick="document.getElementById('newTimeTablePromptModal').style.display='none'"
                          class="w3-button w3-display-topright">&times;</span>
                          <div class="">
                <div class="w3-text-grey">
                    <h1>Create Timetable</h1>
                    <h6>Select Type </h6>
                </div>
                <div class='w3-white w3-margin'>
                    <div class="w3-margin w3-row w3-center">
                        <a href="timetables/create?type=teaching" class="w3-left w3-third" style="text-decoration: none;">
                            <div class="w3-green w3-round w3-border w3-padding w3-row w3-margin-top w3-text-grey">
                                <h6 class="w3-text-white">Teaching Timetable</h6>
                            </div>
                        </a>
                        <a href="timetables/create?type=cover"  class="w3-left w3-third" style="text-decoration: none;">
                            <div class="w3-orange w3-round w3-border w3-padding w3-row w3-margin-top w3-text-grey">
                                <h6 class="w3-text-white">Free Teachers / Cover Timetable</h6>
                            </div>
                        </a>
                        <a href="timetables/create?type=examinations" class="w3-left w3-third" style="text-decoration: none;">
                            <div class="w3-light-gray w3-round w3-border w3-padding w3-row w3-margin-top w3-text-grey">
                                <h6 class="w3-text-green">Examinations Timetable</h6>
                            </div>
                        </a>
                        <a href="timetables/create?type=invigilation" class="w3-left w3-third" style="text-decoration: none;">
                            <div class="w3-blue w3-round w3-border w3-padding w3-row w3-margin-top w3-text-grey">
                                <h6 class="w3-text-white">Invigilation Timetable</h6>
                            </div>
                        </a>
                        
                    </div>
                </div>

            </div>
                </div>
            </div>
        </div>
       
@endsection