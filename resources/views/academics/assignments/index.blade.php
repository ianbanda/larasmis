@extends('main')
@section('title', 'Academics')
@section('content')

<div class="w3-tiny Assig" style="width:80%;margin:auto">
    <br>
    <div class="w3-text-white">
        <h1 class="w3-margin w3-row">
            <div class="w3-left redfont"><b>Assigment / Homework List</b></div>
            <div class="w3-right">
                <button class="w3-btn bluetheme w3-card w3-round w3-large w3-text-white" onclick="document.getElementById('newAssignmentFormModal').style.display = 'block'">
                    + New Assig
                </button>
            </div>
        
        </h1>
    </div>
    
    <div class="assigsearch w3-margin w3-row w3-grey w3-round-xlarge w3-card">
            <img class="w3-col w3-margin" src="{bits}/Resources/Images/search.png" style="width:45px" />
            <h3 class="w3-rest w3-margin-right w3-margin">
                <input class="w3-input w3-round-xlarge w3-border-0 w3-padding" style="padding-left:30px;font-weight:bold" name="assigSearchTF" onkeyup="search.liveSearch('assigSearchTF')" type="text" placeholder="Search for Homeworks / Assignments" />
                <ul id="assigSearchResults" class="w3-white w3-ul w3-card" style="position:absolute;width:80%;display:none">
                </ul>
            </h3>
        </div>
    <br>
    <div class="w3-row w3-margin">
        <div class="w3-row w3-large">
            <div class="w3-left w3-quarter w3-white w3-padding w3-round w3-border">
                <b>
                    <select class="w3-select w3-white w3-padding w3-border-0 w3-text-grey" name="classlevel" onchange="general.selectChanged()">
                        <option value="0">All Terms</option>
                        <!-- START levelslist -->
                        <option value="{ID}">{name}</option>
                        <!-- END levelslist -->
                    </select>
                </b>
            </div>
            <div class="w3-left w3-third w3-white w3-padding w3-round w3-border w3-margin-left w3-margin-right">
                <b>
                    <select class="w3-select w3-white w3-padding w3-border-0 w3-text-grey" name="assigclass" onchange="general.selectChanged()">
                        <option value="0">All Classes</option>
                        <!-- START classlist -->
                        <option value="{ID}">{name}</option>
                        <!-- END classlist -->
                    </select>
                </b>
            </div>
            <div class="w3-left w3-third w3-white w3-padding w3-round w3-border">
                <b>
                    <select class="w3-select w3-white w3-padding w3-border-0 w3-text-grey" name="assigsubject" onchange="general.selectChanged()">
                        <option>All Subjects</option>
                        <!-- START subjectlist -->
                        <option value="{ID}">{name}</option>
                        <!-- END subjectlist -->
                    </select>
                </b>
            </div>
        </div>
        
    </div>
    
    <div id='Assiglist' class="w3-margin" style="">

        <ul class="w3-ul Assig  w3-margin" id='assiglist'>
            @foreach ($assignments as $assignment)
            <li class=" w3-white w3-border w3-round w3-margin-bottom">
                <div class="Assig w3-row">
                    <input paperid='{paperid}' class="w3-left w3-margin-top w3-margin-right paperlistcbx" onclick="papers.selectCBX()" type="checkbox" />
                    <div class="w3-left w3-margin-left w3-twothirds">
                        <div class="bluefont w3-small w3-border-bottom" id="paper{paperid}">
                            <b class="w3-margin-right w3-text-white w3-tiny w3-grey w3-padding w3-margin-bottom">{{$assignment->subjectabbr}}</b>
                            <b class="w3-large"><a href="">{{$assignment->name}}</a></b>
                        </div>                        
                        <div class="redfont w3-tiny w3-row">
                            <div class="w3-left w3-margin-right w3-text-green"><b id="classname{ID}">{classabbrs}</b></div>
                            <div class="w3-left w3-margin-right w3-text-grey"><b>Out Of:</b>{{$assignment->outof}}</div>
                            <div class="w3-left w3-margin-right w3-text-grey"><b>Due Date:</b>{{$assignment->duedate}}</div>
                            <div class="w3-left w3-margin-right w3-text-grey"><b>Creation Date:</b>{{$assignment->datecreated}}</div>
                            <div class="w3-left w3-margin-right w3-text-grey"><b>Created By:</b>{{$assignment->creatorname}}</div>
                        </div> 
                        <div class="w3-text-grey">
                            <b>Submission Percentage : </b>{{$assignment->submissionpercentage}}%
                        </div>                       
                    </div>
                    <div class="w3-right">
                        <button class="w3-green w3-btn w3-text-white w3-round w3-margin-bottom" style="{publishBtnStyle}" onclick="assignment.processAssigPaper('publish','{paperid}','{classid}','{name}');">Publish</button>                        
                        <button class="redtheme w3-btn w3-text-white w3-round" style="" onclick="document.getElementById('AssigModal').style.display='block';assignment.processAssigPaper('{fillBtnAction}','{paperid}','{classid}','{name}');">{fillBtnText}</button>                        
                    </div>
                </div>
            </li>
            @endforeach
            <!-- START assignmentlist -->
            
            <!-- END assignmentlist -->

        </ul>  

    </div>
</div>

<!-- Modals -->
<!-- Assig List Modal -->
<div id="AssigModal" class="w3-modal">
    <div class="w3-modal-content w3-light-gray">
        <div class="w3-container">
            <span onclick="document.getElementById('AssigModal').style.display = 'none'"
                  class="w3-button w3-display-topright">&times;</span>
            <div class=""  id="epmodalCont">
                <div class="w3-text-grey">
                    <h1 id='modalPaperName' class="redfont" rel="">Paper Name</h1>
                    <h6 id='modalPaperClass' class="bluefont">Year 11 Science </h6>
                </div>
                <div class="w3-white w3-margin" style="overflow: auto; max-height: 400px;">
                    <div class="w3-margin" id="stdlist">
                        <div class="w3-light-gray w3-round w3-border w3-row w3-margin-top">
                            <div class="w3-round-xxlarge w3-left w3-border w3-white" style="padding: 5px;margin: 5px;">
                                <div class="w3-round-xxlarge bgpiccover" style="background-image: url(Views/default/images/user.png);height: 50px; min-width:50px;padding: 5px;margin:5px"></div>
                            </div>
                            <div class="w3-margin-left  w3-left">
                                <h4 class="w3-small">Ian Bryan Banda </h4>
                                <b class="w3-small">Year 11 science</b>
                            </div>
                            <div class="w3-margin w3-text-grey w3-right w3-quarter">
                                <input class="w3-input" placeholder="0.0" />
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="w3-row w3-margin-bottom">
                    <button id="classid" classid="" paperid="" class="w3-right w3-btn bluetheme w3-round w3-card w3-margin" onclick="assignment.processAssigPaper('submitmarks','{classid}','{classid}')">Submit</button>
                </div>
            </div>

        </div>
    </div>
</div>
<div id="newAssignmentFormModal" class="w3-modal">
    <div class="w3-modal-content w3-light-gray">
        <div class="w3-container w3-white">
            <span onclick="document.getElementById('newAssignmentFormModal').style.display = 'none'"
                  class="w3-button w3-round-xxlarge w3-display-topright">&times;</span>
            <div class="w3-white w3-text-grey w3-small">
                <h3 class="redfont w3-padding"><b>New Assignment </b></h3>
                <div class=" ">
                        <input name="newAssigForm" value="1" type="hidden">
                        <div class="w3-padding w3-container w3-row w3-small">
                            <b class="w3-left w3-margin-right bluefont w3-margin-bottom">Assignment Name/Title</b><br>
                            <input type="text" class="w3-input w3-border" name="napAssigName" value="" placeholder="Type your title here....."><br>               
                            <br>
                            <b class="w3-left w3-margin-right bluefont w3-margin-bottom">Assignment File/Document</b>
                            <input id="napFile" type="file" class="w3-input" name="napFile" value="" style="display:none;width:0px;" placeholder="Assigment Name">
                            <button class="w3-btn redtheme w3-card w3-round" onclick="$('#napFile').click()">Browse</button><br>               
                            <br>
                            <div class="w3-row">
                                <b class="w3-left w3-margin-right w3-quarter bluefont">Due Date</b>
                                <input class='w3-text-grey' type="date" id="napDueDate" name="napDueDate" value="ca">
                                
                            </div>
                            <br>
                            <div class="w3-row">
                                <b class="w3-left w3-margin-right w3-quarter bluefont">Out of</b>
                                <input type="text" class=" w3-left" name="napOutof" value="" placeholder="e.g. 40">
                            </div>
                            <br>               
                            <br>
                            <select id="year" name="napClassLevel" class="w3-select w3-margin-bottom w3-border w3-padding" onchange="selectChanged()">
                                <option value="year 1">All Levels</option>
                                <!-- START naplevelslist -->
                                <option class="w3-padding" value="{ID}">{name}</option>
                                <!-- END naplevelslist -->

                            </select><br>
                            <div class="w3-row">
                                <b class="bluefont">Classes</b>
                                <div class="w3-row w3-margin-bottom" id="napClassesDIV">
                                    <!-- START napclasslist -->
                                    <div class="w3-left w3-margin-right w3-small">{name}&nbsp;<input class="" type="checkbox" name="napClasses[]" value="{ID}" /></div>
                                    <!-- END napclasslist -->
                                </div>
                            </div>
                            <select id="subject" name="napSubject" class="w3-select w3-margin-bottom" onchange="selectChanged()">
                                <option value="All Subjects">All Subjects</option>
                                <!-- START napsubjectlist -->
                                <option value="{ID}">{name}</option>
                                <!-- END napsubjectlist -->
                            </select><br>
                            <div class="w3-row">
                                <button class="w3-btn w3-right w3-grey" onclick="formObject.submitForm('newAssignment')">Submit</button>
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div id="actionbtns" class="w3-padding w3-center w3-black" style="position:fixed;bottom:0;left:0; width:100%; display:none">
    <input class="w3-btn w3-red w3-round-large" onclick="papers.deletePapers('assignment')" type="button" value="Delete Papers"/>
</div>




@endsection