@extends('main')
@section('title', 'View Class')
@section('content')

<div id='initAction' class='{initAction}'></div>
<div id='pagename' class='classview'></div>
<div class=" exams" style="width:90%;margin:auto">
    <div class="w3-text-white">
        <h1 class="w3-margin w3-row">
            <div class='w3-row redfont'>
                <div class="w3-row">
                <div  class=" w3-left">
                        <div class="">
                            <b id="classabbr" class="w3-round-large w3-large w3-padding w3-border bluefont w3-margin-right">{{$class->abbr}}</b>
                            <b id="classname" class="">{{$class->name}}</b>
                        </div>
                        
                    </div>
                    <div class="w3-row w3-right">
                        
                        <button class='w3-right w3-btn redfont w3-white w3-border w3-border-red w3-border-grey w3-card w3-large w3-margin w3-round-large' onclick="attendance.showClassAttencanceModal('{{$class->ID}}','Daily')"> Take Attendance</button>
                        <button class='w3-right w3-btn redfont w3-white w3-border w3-border-red w3-border-grey w3-card w3-large w3-margin w3-round-large' onclick="attendance.showClassAttencanceModal('{{$class->ID}}','Daily')"> Exams & Tests</button>
                        <button class='w3-right w3-btn redfont w3-white w3-border w3-border-red w3-border-grey w3-card w3-large w3-margin w3-round-large' onclick="stdclass.showClassHWModal()"> Homeworks</button>
                    </div>
                </div>
                
                
                <h2 class="bluefont w3-row">
                    <div class="w3-left">Summaries</div>
                    <div class="w3-right">
                        <button class="w3-btn w3-white w3-small w3-text-blue" onclick="stdclass.showOtherClassesLinkModal()"><b>Go To Other Classes</b></button>
                    </div>
                    <div class="w3-right">
    				    <div class="w3-row w3-text-grey w3-large">
    						<div class="w3-row w3-left w3-margin-right">
    							<div class="w3-right">Form Teacher(s)</div>
    							<div class="w3-right">
    								<button
    									class='w3-right w3-btn redfont w3-tiny w3-round-large'  
                                        onclick="stdclass.loadFormTeacherEditForm('fteachers')">
    								    Edit
    								</button>
    							</div>
    						</div>
        					<div class="w3-row mainfts w3-left">
        						<!-- START ftlist --> 
                                @forelse ($formteachers as $fteacher)
                                    <div id='{{$fteacher->teacherid}}' class="ft w3-left w3-white w3-round-large w3-border w3-padding w3-margin-right" style="font-size:10px;">
                                        {{$fteacher->teachername}}
                                    </div>
                                @empty
                                    <span>Not Assigned</span>
                                @endforelse
        						
        						<!-- END ftlist -->
        					</div>
    				    </div>
				    </div>

                    
                </h2>
                <div class="">
                    <div class="w3-container w3-white w3-large w3-border w3-white w3-cell w3-margin-right">
                        <div class="w3-row w3-gray ">
                            <div class="w3-container w3-white w3-cell w3-btn summaryTab" onclick="stdclass.summaryTab(this,'perfomance','students')">
                                 <b class=" w3-margin w3-round " >
                                        Student List
                                </b>
                            </div>
                            <div class="w3-container w3-gray w3-cell w3-btn" onclick="stdclass.summaryTab(this,'perfomance','homework')">
                                <b class="w3-margin w3-round">
                                        Homework
                                </b>
                            </div>
                            
                            <div class="w3-container w3-gray w3-cell w3-btn"  onclick="stdclas.summaryTab(this,'perfomance','tests')">
                              
                                <b class="w3-margin w3-round ">
                                    Tests
                                </b>
                              
                            </div>
                            
                            <div class="w3-container w3-gray w3-cell w3-btn"  onclick="stdclass.summaryTab(this,'perfomance','finalexam')">
                                <b class="w3-margin w3-round " >
                                    Final Exam 
                                </b>
                            </div>
                            
                            <div class="w3-container w3-gray w3-cell w3-btn" onclick="stdclass.summaryTab(this,'perfomance','overall')">
                                <b class="w3-left w3-margin w3-round">
                                    Overall 
                                </b>
                            </div>
                        </div>
                       
                        <div class="w3-row w3-small" id="tabsubbuttons">
                            <button class="students w3-btn w3-left w3-large w3-margin w3-card w3-round w3-border w3-white" onclick="reports.generateNow('classfile')">
                                <img src="{bits}Resources/Images/export_pdf.png" class="w3-margin-right" style="width:25px"/>
                                Student List
                            </button>
                            <button class="overall w3-btn w3-left w3-large w3-margin w3-card w3-round w3-border w3-white" style="display:none" onclick="reports.generateNow('classtestsummary')">
                                <img src="{bits}Resources/Images/export_pdf.png" class="w3-margin-right" style="width:25px"/>
                                Generate Summary
                            </button>
                        </div>
                        <div class="w3-margin-top">
                            <select name='reptype'>
                                <option value="both">Score and Grade</option>
                                <option value="score">Grades Only</option>
                                <option value="grade">Scores Only</option>
                            </select>
                        </div>
                    </div>
                    <div class='w3-container w3-cell '>
                        <div class='w3-margin-left'>
                            <h3 class='w3-row w3-cell-middle w3-border-bottom'>
                                <b class='w3-left w3-margin-right w3-text-grey w3-margin-bottom'>Students Taking</b>
                                <select name='stdtakingsubSelect' id='stdtakingsubSelect' class="w3-small w3-right w3-padding" onchange='general.selectChanged()'>
                                    <!-- START subjectlist1 -->
                                    @foreach ($classsubjects as $subject)
                                        <option value='{{$subject->subjectid}}' subname='{{$subject->name}}'>{{$subject->abbr}}</option>
                                    @endforeach
                                    
                                    <!-- END subjectlist1 -->
                                </select>
                            </h3>
                            <div class='w3-row' id='stdsubstats'>
                                <h1 class='w3-left total w3-padding' style='font-weight:bold'>
                                    0
                                </h1>
                                <div id='' class='w3-right'>
                                    <canvas id="subjectStdCanvas" style="width:100%;max-width:600px"></canvas>
                                </div>
                                <div class="w3-left w3-padding">
                                    <button
    									class='w3-btn redfont w3-card w3-white w3-border w3-border-red w3-tiny w3-round-large'  
                                        onclick="stdclass.loadSubjectStdsEditForm()">
    								    Edit
    								</button>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                    
            </div>
            <div id='classid' class='{classid}'></div>
            
        </h1>
    </div>
    <div class="w3-row">
        <div class="w3-col">
			<div  class="w3-row w3-hide-small">
				<div class="w3-quarter">
				    <div class="w3-row w3-margin ">
					
					<button class="w3-btn w3-card w3-dark-grey w3-round w3-padding w3-large" onclick="stdclass.stdSubjectMatrix()">
					    <h6>Student Subject Matrix</h6>
					</button>
				</div>
				</div>
				<div class="w3-threequarter">
				    <div class="w3-row w3-margin ">
					<h6>
						<div class="w3-row">
						    <div class="w3-left">
								<button
									class='w3-right w3-btn w3-small w3-round-large redfont'  
									onclick="subjects.loadSubjectEditForm('class')">
								    Edit
								</button>
							</div>
							<div class="w3-left">Subjects</div>
							<div class="w3-row mainsubs w3-left w3-margin-left">
        						<!-- START subjectlist --> 
                                @foreach ($classsubjects as $subject)
                                <div id='{subjectid}' abbr="{abbr}" class="sub w3-left w3-white w3-round-large w3-border w3-padding w3-margin-right" style="font-size:10px;">
        						    {{$subject->abbr}}
        						</div>
                                @endforeach
        						
        						<!-- END subjectlist -->
        					</div>
							
						</div>
					</h6>
					
					<div id="classsubabbrs" class="w3-row " style='display:none'>
					    &lt;td&gt;&lt;/td&gt;
						<!-- START subjectabbrlist --> 
                        @foreach ($classsubjects as $subject)
						    &lt;td&gt;{{$subject->abbr}}&lt;/td&gt;
                        @endforeach
						<!-- END subjectabbrlist -->
					</div>
				</div>
				</div>
            </div>
            
        </div>
        <div class="w3-rest" style="width:100%">
            <div class="search w3-row w3-margin">
                <input class="w3-input w3-padding" placeholder="Search Student" />
            </div>
            <div id="tabcontainer" init="1">
                <div class="w3-twothird" style="">
                    <h3 class="w3-row">
                        <b class="w3-left">Students In {{$class->name}}</b>
                        <button class='w3-right w3-btn redtheme w3-small w3-margin w3-round-large'  onclick="document.getElementById('newStudentModal').style.display = 'block'">+ Create New Student</button>
                        <button class='w3-right w3-btn redtheme w3-small w3-margin w3-round-large'  onclick="document.getElementById('editStudentsModal').style.display = 'block'">Edit Students</button>
                    </h3>
                    <div class="w3-white w3-border" style="">
    
                        <ul id="studentlist" class="w3-ul exams w3-margin">
                            @foreach ($classstudents as $std)
                            <li id="{user_id}">
                                <div class="exam w3-row">
        						<input stdid='{studentid}' class="w3-left w3-margin-top w3-margin-right stdlistcbx" onclick="stdclass.stdselectCBX()" type="checkbox" />
                                    <div class="w3-round-xxlarge w3-left w3-light-gray bgpiccover" style="background-image: url({bits}Views/default/images/{gender}user.png);height: 40px; min-width:40px;padding: 5px;margin: 5px"></div>
                                    <div class="w3-left w3-margin-left w3-small">
                                        <div class="w3-row">
                                            <b class="bluefont w3-margin-right w3-left">{{$std->stdcode}}</b>
                                            <div class="w3-left redfont stdname">{{$std->stdname}}</div>        
                                        </div>
                                        <div class="w3-text-grey w3-tiny w3-row">
                                            <div class="w3-left subjects">{{$std->subjectstaken}}</div>
                                        </div>                        
                                        <div class=" w3-tiny w3-row">
                                            <div class="w3-left atthist w3-text-green w3-margin-right"><b>{{$std->gender}}</b></div>
                                            <div class="w3-left atthist"><b>{{$std->atthist}}</b></div>
                                        </div>                        
                                    </div>
                                    <div class="w3-row w3-right w3-card">
                                        <div class="w3-right w3-hide-small">
                                        <a href='student/view?id={studentid}&section=academic' class="w3-black w3-tiny w3-btn w3-text-white">View</a>                        
                                        </div>
                                        <div class="w3-right w3-hide-small">
                                            <button class="w3-light-gray w3-tiny w3-btn" stdname="{{$std->stdname}}" onclick="stdclass.showStdTransferModal(this,'{{$std->user_id}}','{stdcode}')">Transfer</button>                        
                                        </div>    
                                    </div>
                                    
        							<div class="w3-left w3-hide-large">
                                        <a href='{bits}student/view?id={studentid}&section=academic' class="redtheme w3-tiny w3-btn w3-text-white w3-round">View</a>                        
                                    </div>
                                </div>
                            </li>
                            @endforeach
                           
        
                        </ul>  
        
                    </div>
                </div>
                <div class="w3-hide-small w3-third">
                    <div class="w3-margin-left">
                        <h3 class="w3-margin-left w3-center"><b>Attendance Today</b></h3>
                        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- The edit Subject Students Modal -->
<div id="editSubjectStudentsModal" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('editSubjectStudentsModal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <div id='classAttModalCont'>
		<h3 class='redfont title' style='font-weight:bold'>Students taking </h3>
        <div class='w3-row w3-tiny w3-text-grey'>
            <h4 class="w3-text-grey w3-border-top">{{$class->name}}</h4>
        </div>
        <div class='' style='overflow-y: auto;height: 150px;'>
            <table id='subjectstdstable'>
                <thead>
                    <tr class="w3-white">
                        <th class="w3-white" style='position: sticky;top: 0;'>Student Name</th>
                        <th class="w3-white" style='position: sticky;top: 0;'>Taking Subject</th>
                    </tr>
                </thead>
                <tbody>
                    <tr></tr>
                </tbody>
            </table>
        </div>
        
		<div class="w3-row w3-border-top">
			<button onclick="stdclass.saveSubjectStudentsAlloc()" class="w3-btn w3-border w3-padding w3-small w3-margin w3-right">
				Save Allocations                      
			</button>
		</div>
	  </div>
    </div>
  </div>
</div>

<!-- The edit Class Form Teachers Modal -->
<div id="editFormTeachersModal" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('editFormTeachersModal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <div id='classAttModalCont'>
		<h6>Edit Form Teachers</h6>
        <div class='w3-row w3-tiny w3-text-grey'>
            <div class='w3-third w3-margin-bottom w3-left ' style='padding-right:15px;'>
                <h6>Assigned</h6>
                <div id='a' class="w3-ul w3-row ftassigned">
                    <!-- START eftlist -->
                    @foreach ($formteachers as $ft)
                		<button id="{teacherid}" onclick="buttons.selectButton()"  selected="yes" 
					    class="w3-tiny w3-border w3-input w3-margin-bottom w3-border-red w3-btn w3-round-large w3-left w3-border w3-padding w3-red">
                            {{$ft->teachername}}
                        </button>
                    @endforeach 
					<!-- END eftlist -->
				</div>
            </div>
			<div class='w3-third w3-margin-bottom  ' style='padding:15px;'>
                <button 
					onclick="buttons.moveButton('r',1)"
					class="w3-large w3-border w3-margin-bottom w3-twothird w3-border-black w3-btn w3-round-large w3-padding w3-white">
					&rarr;
				</button>
				<button
					onclick="buttons.moveButton('l',1)"
					class="w3-large w3-border w3-margin-bottom w3-twothird w3-border-black w3-btn w3-round-large w3-padding w3-white">
					&larr;
				</button>
				<button
					onclick="buttons.moveButton('r',100)"
					class="w3-large w3-border w3-margin-bottom w3-twothird w3-border-black w3-btn w3-round-large w3-padding w3-white">
					&rarr;&rarr;
				</button>
				<button 
					onclick="buttons.moveButton('l',100)"
					class="w3-large w3-border w3-margin-bottom w3-twothird w3-border-black w3-btn w3-round-large w3-padding w3-white">
					&larr;&larr;
				</button>
            </div>
            <div class='w3-third w3-margin-bottom  ' style='padding-right:15px;'>
                <h6>Not Assigned</h6>
                <div id='na' class="w3-ul w3-row ftnotassigned"  style="max-height:250px;height:250px;overflow-y:auto">
                    <!-- START nonftlist -->
                    @foreach ($nonformteachers as $nft)
					<button
					    onclick="buttons.selectButton()"
					    selected="yes" class="w3-tiny w3-border w3-border-red w3-input w3-margin-bottom w3-btn w3-round-large w3-left w3-border w3-padding w3-white">
					{{$nft->teachername}}
					</button>
                    @endforeach
					<!-- END nonftlist -->
				</div>
            </div>
            
        </div>
		<div class="w3-row w3-border-top">
			<button onclick="stdclass.saveFormTeacherAllocation('fteachers','{id}')" class="w3-btn w3-border w3-padding w3-small w3-margin w3-right">
				Save Form Teachers                      
			</button>
		</div>
	  </div>
    </div>
  </div>
</div>
	

<!-- The edit Class Subjects Modal -->
<div id="editClassSubjectsModal" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('editClassSubjectsModal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <div id='classAttModalCont'>
		<h6>Edit Class Subjects</h6>
        <div class='w3-row w3-tiny w3-text-grey'>
            <div class='w3-third w3-margin-bottom w3-left ' style='padding-right:15px;'>
                <h6>Assigned</h6>
                <div id='a' class="w3-ul w3-row assigned">
					<button id="{subjectid}"
						onclick="subjects.selectSubjectButton()"
					selected="yes" class="w3-tiny w3-border w3-border-red w3-btn w3-round-large w3-left w3-border w3-padding w3-red">
					ICT
					</button>
				</div>
            </div>
			<div class='w3-third w3-margin-bottom  ' style='padding:15px;'>
                <button 
					onclick="subjects.moveSubject('r',1)"
					class="w3-large w3-border w3-margin-bottom w3-twothird w3-border-black w3-btn w3-round-large w3-padding w3-white">
					&rarr;
				</button>
				<button
					onclick="subjects.moveSubject('l',1)"
					class="w3-large w3-border w3-margin-bottom w3-twothird w3-border-black w3-btn w3-round-large w3-padding w3-white">
					&larr;
				</button>
				<button
					onclick="subjects.moveSubject('r',100)"
					class="w3-large w3-border w3-margin-bottom w3-twothird w3-border-black w3-btn w3-round-large w3-padding w3-white">
					&rarr;&rarr;
				</button>
				<button 
					onclick="subjects.moveSubject('l',100)"
					class="w3-large w3-border w3-margin-bottom w3-twothird w3-border-black w3-btn w3-round-large w3-padding w3-white">
					&larr;&larr;
				</button>
            </div>
            <div class='w3-third w3-margin-bottom  ' style='padding-right:15px;'>
                <h6>Not Assigned</h6>
                <div id='na' class="w3-ul w3-row notassigned">
					<button
					onclick="subjects.selectSubjectButton()"
					selected="yes" class="w3-tiny w3-border w3-border-red w3-btn w3-round-large w3-left w3-border w3-padding w3-white">
					ICT
					</button>
				</div>
            </div>
            
        </div>
		<div class="w3-row w3-border-top">
			<button onclick="subjects.saveSubjectAllocation('class','{id}')" class="w3-btn w3-border w3-padding w3-small w3-margin w3-right">
				Save Subjects
			</button>
		</div>
	  </div>
    </div>
  </div>
</div>
	
<!-- edit Class Subjects Modal -->
<!-- The Modal -->
<div id="otherClassLinksModal" class="w3-modal w3-round w3-card">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('otherClassLinksModal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <div id='classAttModalCont'>
        <div class='w3-row w3-tiny w3-text-grey'>
            
            <div class='w3-padding' id='camrc'>
                <br>
                <h3 class="w3-center"><b class="w3-text-blue w3-margin-bottom">
                    <a href="./" class="w3-btn w3-round-large w3-blue w3-margin-bottom">All Class List</a></b><br> 
                </h3>
                <br>
                <div class="w3-margin-bottom" style="max-height:100px;">
                    <ul id="classAttendanceStdList" class="w3-ul">
                        <!-- START gotoclasslist -->
                        @forelse ($gotoclasslist as  $gtc)
                            <a href="?classid={{$gtc->ID}}">
                                <li class="w3-row w3-third w3-padding">
                                    <div class="w3-border w3-round-large">
                                        <h1 class="w3-border-bottom w3-text-grey w3-center"><b>{{$gtc->abbr}}</b></h1> 
                                        <div class="w3-center redfont">{{$gtc->name}}</div>
                                    </div>
                                </li>
                            </a>
                        @empty
                            There are no more classes to display
                        @endforelse
                        
                        <!-- END gotoclasslist -->
                    </ul>
                    <br>
                </div>
                <br>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
	
<!-- edit Class Subjects Modal -->
<!-- The Modal -->
<div id="takeRegModal" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('takeRegModal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <div id='classAttModalCont'>
        <div class='w3-row w3-tiny w3-text-grey'>
            <div class='w3-left w3-margin-right w3-margin-bottom  w3-border-right' style='padding-right:15px;'>
                <h4 class="bluefont w3-margin-top"><b>Date</b></h4>
                <input type='date' class='w3-small w3-input w3-border' id="attendanceDate" value="{date}" />
                <div class="" style="display:none">
                    <h4 class="bluefont w3-margin-top"><b>Subject</b></h4>
                    <select class="w3-smallw3-border w3-select"><option>Select Subject</option></select>
                </div>
            </div>
            <div class='w3-margin w3-left  w3-padding' id='camrc'>
                <h3><b class="redfont w3-border-bottom w3-margin-bottom w3-margin-right">{{$class->name}}</b> | Take Attendance Register</h3>
                <div class="">
                    <ul id="classAttendanceStdList" class="w3-ul">
                        <!-- START classAttendanceStdList -->
                        <li class="w3-row">
                            <div class="w3-left w3-small">
                            {stdname}
                            </div>
                            <button id="{user_id}" class="w3-btn attstatusbtn w3-right w3-margin-left {attstatuscolor} w3-card w3-round w3-small" onclick="attendance.statusBTN(this)">{attstatus}</button>
                        </li>
                        <!-- END classAttendanceStdList -->
                    </ul>
                </div>
                <div class="w3-row w3-margin-top">
                    <button class="w3-btn w3-right w3-margin-top w3-card w3-round bluetheme w3-small"
                        onclick="attendance.saveNow('{classid}')">
                        <b>Save Now</b>
                    </button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<div id="classHWModal" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('classHWModal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <div id='classHWModalCont'>
        <div class='w3-row w3-tiny w3-text-grey'>
            
            <div class='w3-margin w3-left  w3-padding' id='camrc'>
                <h2><b class="redfont w3-margin-bottom w3-margin-right">{{$class->name}}</b> | Homeworks & Assignments</h2>
                <div class="w3-row">
                    <div class="w3-third">
                        Term
                        <select class="w3-select w3-border w3-large w3-margin-top">
                            <option>Term 1</option>
                        </select>
                    </div>
                    <div class="w3-third">
                        Subject
                        <select class="w3-select w3-border w3-large w3-margin-top">
                            <option>Term 1</option>
                        </select>
                    </div>
                </div>
                <div class="" style="max-height:100px;">
                    <div class="w3-row" id="classhws">
                        <div class='w3-third w3-left'>
                            <div class='w3-margin w3-border'>
                                <h1 class='w3-center redfont'>ICT</h1>
                                <div class='w3-center w3-tiny'>Introduction To Paper 1</div>
                                <div class='w3-center w3-tiny'>Out of 50</div>
                                <div class='w3-center w3-tiny redfont'>Term 1</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w3-row w3-margin-top">
                    <button class="w3-btn w3-right w3-margin-top w3-card w3-round bluetheme w3-small"
                        onclick="attendance.saveNow('{classid}')">
                        <b>Save Now</b>
                    </button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<div id="stdTransferModal" class="w3-modal" stdid=''>
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('stdTransferModal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <div id='stdTransferModalCont'>
        <div class='w3-row w3-tiny w3-text-grey'>
            
            <div class='w3-margin  w3-padding' id='camrc'>
                <h2><b>Transfer Student Between Classes</b></h2>
                <h3><b class="redfont stddetails w3-margin-bottom w3-margin-right" stdid="" stdcode="">Name of student</b></h3>
                <br/>
                <h4 class="w3-row w3-border-top">
                    <br>
                    <div class="w3-left w3-quarter">From : </div>
                    <div class="w3-left w3-threequarter">
                        <b class="">{{$class->name}}</b>
                    </div>
                </h4>
                <h4 class="w3-row">
                    <div class="w3-left w3-quarter">To : </div>
                    <div class="w3-left w3-threequarter">
                        <b class="bluefont">
                            <select name="selectDestClass" id="selectDestClass" class="w3-select">
                                <!-- START otherclasslist -->
                                <option class="w3-row" value="{ID}">
                                    {name}
                                </option>
                                <!-- END otherclasslist -->
                            </select>
                        </b>
                    </div>
                </h4>
                <h4 class="w3-row w3-border-top">
                    <br>
                    <div class="w3-left w3-quarter">Term : </div>
                    <div class="w3-left w3-threequarter">
                        <b class="bluefont">
                            <select name="selectTransferTerm" id="selectTransferTerm" class="w3-select">
                                <!-- START termslist -->
                                @foreach ($termslist as $term)
                                    <option class="w3-row" value="{ID}">
                                        {{$term->name}}
                                    </option>
                                @endforeach
                                <!-- END termslist -->
                            </select>
                        </b>
                    </div>
                
                </h4>
                
                <div class="w3-row w3-margin-top">
                    <button class="w3-btn w3-right w3-margin-top w3-card w3-round bluetheme w3-small"
                        onclick="stdclass.submitTransfer()">
                        <b>Save Now</b>
                    </button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<div id="stdSubjectMatrixModal" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('stdSubjectMatrixModal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <div id='stdTransferModalCont'>
        <div class='w3-row w3-tiny w3-text-grey'>
            
            <div class='w3-margin  w3-padding' id='camrc'>
                <h2 class="w3-center"><b>Student Subject Allocation</b></h2>
                <h3 class="">
                    <div class="w3-half">
                        <b class="redfont stddetails w3-margin-bottom w3-margin-right" stdid="" stdcode="">{{$class->name}}</b>
                    </div>
                    <div class="w3-half w3-large w3-row">
                        <div class="w3-large w3-left w3-quarter">Term</div>
                        <select class="w3-select w3-padding w3-border w3-round w3-threequarter" name="selectStdSubjectTerm" id="selectStdSubjectTerm">
                            <!-- START classtermslist -->
                            @foreach ($termslist as $term)
                                <option class="w3-row w3-text-grey" value="{ID}">
                                    <b>{{$term->name}}</b>
                                </option>
                            @endforeach
                            
                            <!-- END classtermslist -->
                        </select>
                    </div>
                    
                </h3>
                <h4 class="w3-row">
                    <br>
                    <div class="w3-left">Showing Student-Subject Allocation in Relation To Available Class Subjects</div>
                    
                </h4>
                
                <div id="stdSubjectMatrixModalCont">
                    
                </div>
                
                <div class="w3-row w3-margin-top">
                    <button class="w3-btn w3-right w3-margin-top w3-card w3-round bluetheme w3-small"
                        onclick="stdclass.saveStdSubjectMatrix()">
                        <b>Save Now</b>
                    </button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modals -->
<!-- Edit Student  Modal -->
<div id="editStudentsModal" class="w3-modal">
    <div class="w3-modal-content w3-light-gray">
        <div class="w3-container">
            <span onclick="document.getElementById('editStudentsModal').style.display = 'none'"
                  class="w3-button w3-display-topright">&times;</span>
            <div class="">
                <div class="w3-text-grey">
                    <h3 class=" w3-row">
                        <div classs="w3-left bluefont w3-margin-right"><B>Edit Student Details </B></div>
                        <button class="w3-btn w3-left redfont" onclick="students.creationForm('single')"><b>Class Students </b></button>
                    </h3>
                    <h6>{{$class->name}} </h6>
                </div>
                <div class='w3-white w3-margin' id="">
                    <div class="w3-margin" id="editStudentsForm" style="overflow-y:auto;max-height:250px">
						<div class='{bits}'id="bits" style='display:none;'></div>
                        <br>
                        <!-- START editStudentList -->
                        @foreach ($classstudents as $std)
                            <div class="stdrow w3-light-gray w3-tiny w3-round w3-border w3-padding w3-row w3-margin-bottom w3-text-grey" stdid='{user_id}'>
                                <input class="" type="hidden" name='classid' value="{{$class->ID}}" />
                                <div class="w3-twothird">
                                    <div class="w3-row  w3-left w3-third">
                                        <div class="">Firstname</div>
                                        <input class="w3-input fname" name='fname' value='{{$std->firstname}}' />
                                    </div> 
                                    <div class="w3-row w3-left w3-third" style='padding-left:5px'>
                                        <div class="">Othernames</div>
                                        <input class="w3-input onames" name='onames' value='{{$std->othernames}}' />
                                    </div>
                                    <div class="w3-row w3-left w3-third" style='padding-left:5px'>
                                        <div class="">Surname</div>
                                        <input class="w3-input sname" name='sname' value='{{$std->surname}}' />
                                    </div>
                                </div>
                                <div class='w3-third'>
                                    <div class="w3-row w3-half" style='padding-left:5px'>
                                    <div class="w3-row">
                                        <div class='w3-left'>Date of Birth</div> 
                                        <a href='#' onclick='$("editdoblink{{$std->user_id}}").show();$(".dob{{$std->user_id}}").show();$(".dobdp{{$std->user_id}}").hide();$(this).hide()' style='display:none' class='redfont w3-right closedobedit{{$std->user_id}}'><b>x</b></a> 
                                    </div>
                                    <div class="dob{{$std->user_id}} bluefont">{{$std->user_dob}}</div>
                                    <div class=""><a href='#' onclick='$(this).hide();$(".dob{{$std->user_id}}").hide();$(".dobdp{{$std->user_id}}").show();$(".closedobedit{{$std->user_id}}").show();' class='redfont editdoblink{{$std->user_id}}'>Edit DOB</a></div>
                                    <input class="w3-input dob dobdp{{$std->user_id}}" name='dob' type="date" value='{dob}' style='display:none;' />
                                </div>
                                    <div class="w3-row w3-half" style='padding-left:5px'>
                                    <div class="">Gender : {{$std->gender}}</div>
                                    <div class=""><a href='#' onclick='$(this).hide();$(".genderselect{{$std->user_id}}").show()' class='redfont'>Edit Gender</a></div>
                                    <div class="">
                                        <select class="gender w3-select w3-white genderselect{{$std->user_id}}" name='gender' style='display:none;' onchange='$(this).attr("changed","true");' changed='false'>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        <!-- END editStudentList -->
                    </div>
                    
                </div>
                <div class="w3-row w3-margin">
                    <button class="w3-btn w3-right w3-grey" onclick="stdclass.submitStdsEditForm()">Submit</button>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- Exam List Modal -->
<div id="newStudentModal" class="w3-modal">
    <div class="w3-modal-content w3-light-gray">
        <div class="w3-container">
            <span onclick="document.getElementById('newStudentModal').style.display = 'none'"
                  class="w3-button w3-display-topright">&times;</span>
            <div class="">
                <div class="w3-text-grey">
                    <h3 class=" w3-row">
                        <div classs="w3-left bluefont w3-margin-right"><B>Create : </B></div>
                        <button class="w3-btn w3-left redfont" onclick="students.creationForm('single')"><b>Single Student </b></button>
                        <button class="w3-btn w3-left redtheme" onclick="students.creationForm('multiple')"><b>Multiple Students</b></button>
                    </h3>
                    <h6>{name} </h6>
                </div>
                <div class='w3-white w3-margin' id="">
                    <div class="w3-margin" id="newStudentsFormSingle">
						<div class='{bits}'id="bits" style='display:none;'></div>
						
                        <br>
                        <div class="w3-light-gray w3-round w3-border w3-padding w3-row w3-margin-top w3-text-grey">
							<input class="" type="hidden" name='classid' value="{id}" />
                            <div class="w3-row w3-margin-bottom w3-left">
                                <div class="">Firstname</div>
                                <input class="w3-input" name='fname' />
                            </div> 
                            <div class="w3-row w3-margin-bottom w3-left">
                                <div class="">Othernames</div>
                                <input class="w3-input" name='onames' />
                            </div>
                            <div class="w3-row w3-margin-bottom w3-left">
                                <div class="">Surname</div>
                                <input class="w3-input" name='sname' />
                            </div>
                            <div class="w3-row w3-margin-bottom">
                                <div class="">Date of Birth</div>
                                <input class="w3-input" name='dob' type="date" />
                            </div>
                            <div class="w3-row w3-margin-bottom">
                                <div class="w3-left">Gender</div>
                                <div class=" w3-margin-left w3-left">
                                <select class="w3-select w3-white" name='gender'>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                                </div>
                            </div>
                            <div class="w3-row w3-margin">
                                <button class="w3-btn w3-right w3-grey" onclick="formObject.submitForm('newStudent')">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="w3-margin" id="newStudentsFormMultiple" style="display:none">
                        <div style="overflow-y:auto; max-height:200px">
                            <table>
                            
                            </table>
                        </div>
                        <div class="w3-row w3-margin">
                            <button class="w3-btn w3-right w3-grey" onclick="students.saveMultipleStudents('new')">Submit</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div id="actionbtns" class="w3-padding w3-center w3-black" style="position:fixed;bottom:0;left:0; width:100%; display:none">
    <input class="w3-btn w3-red w3-round-large" onclick="stdclass.deleteStudents()" type="button" value="Delete Students"/>
</div>

<div id="transferreport" class="w3-padding w3-center" style="position:fixed;bottom:0;left:0; width:100%; display:none; background:rgba(0,0,0,0.7)">
    <div class="w3-padding w3-margin w3-green">!! Student was successfully transfered !!</div>
</div>

@endsection