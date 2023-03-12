@extends('main')
@section('title', 'Dashboard')
@section('content')
<div class="w3-row">
    <div style="margin-left: auto;margin-right:auto; width:90%;">
        <p id='bits' class="{bits}"><br></p>
        <div class="homesearch w3-margin w3-row w3-grey w3-round-xlarge w3-card">
            <img class="w3-col w3-margin" src="{{asset('/Resources/Images/search.png')}}" style="width:45px" />
            <h3 class="w3-rest w3-margin-right w3-margin">
                <input class="w3-input w3-round-xlarge w3-border-0 w3-padding" style="padding-left:30px;font-weight:bold" name="homeSearchTF" onkeyup="search.liveSearch('homeSearchTF')" type="text" placeholder="Search for Students, Classes, Subjects, Books" />
                <ul id="homeSearchResults" class="w3-white w3-ul w3-card" style="position:absolute;width:80%;display:none">
                </ul>
            </h3>
        </div>
        <br>
        <h1 class="redfont w3-margin-top w3-row">
            <b class="w3-left">Dashboard</b>
            <a href="system/privileges" class="w3-right w3-btn w3-round-large blueborder w3-white w3-card w3-large w3-margin"><b>System Privileges</b></a>
        </h1>
        <div class="redfont"  style="font-weight:bold">
            <div class="w3-third">
                <div class="w3-card w3-row w3-white w3-border-bottom w3-border-red">
                    <img src="Resources/Images/director.png" class="w3-margin w3-col" style="width:15%;">
                    <div class="w3-container redfont w3-rest">
                        <p><a href="staff">STAFF</a></p>
                    </div>
                </div>
            </div>
            <div class="w3-third w3-white ">
                <div class="w3-card w3-row  w3-border-bottom w3-border-red">
                    <img src="Resources/Images/students.png" class="w3-margin w3-col" style="width:15%;">
                    <div class="w3-container redfont w3-rest">
                        <p><a href="students">LEARNERS</a></p>
                    </div>
                </div>
            </div>
            <div class="w3-third w3-white">
                <div class="w3-card w3-row w3-border-bottom w3-border-red">
                    <img src="Resources/Images/academics.png" class="w3-margin w3-col" style="width:15%;">
                    <div class="w3-container redfont w3-rest">
                        <p><a href="academics">ACADEMICS</a></p>
                    </div>
                </div>
            </div>
        </div>
    <br/>
        <div class='w3-container w3-margin w3-white w3-card'>
            <h3 class="bluefont">
                <img src="Resources/Images/classes.png" style="width:30px;margin: 3px">
                <b>Classes<b></h3>
            <div class='w3-row w3-padding w3-white w3-round-xxlarge w3-margin-bottom w3-text-grey' style='max-height:200px;overflow-y:auto'>
                <!-- START homeclasslist -->
                
                <!-- END homeclasslist -->
                @foreach ($classes as $homeclass)
                <div class='w3-left w3-btn w3-padding w3-border w3-card w3-round-xlarge w3-margin'>
                    <a href='classes/view?classid={{$homeclass->ID}}' class='' style='text-decoration:none;'>
                        <h6 class='w3-border-bottom w3-large'>{{$homeclass->abbr}}</h6>
                        <div class='w3-tiny'>Num on roll:<span class='w3-text-green'>{{$homeclass->numonroll}} </span></div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>


        <div class="w3-container w3-padding w3-white w3-margin">
            <h3 class='w3-border-bottom bluefont'>
                <img src="Resources/Images/modules.png" style="width:30px;margin: 3px">
                <b>Modules</b>
            </h3>
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
                <div class="w3-left w3-btn w3-card redtheme w3-margin w3-round-xlarge">
                    <a href="announcements" style='text-decoration:none;'>Announcements</a>
                </div>
                
                <div class="w3-left w3-btn w3-card redtheme w3-margin w3-round-xlarge">
                    <a href="library" style='text-decoration:none;'>Library</a>
                </div>
                
            </div>
        </div>

        <div class="w3-container">
            <div class="w3-row w3-margin-top w3-small w3-card w3-padding w3-border bluefont">
                <div class="w3-left w3-third">
                    <label>Teacher</label>
                    <select name="teachersTTselect" id="teachersTTselect" class="w3-text-red w3-select w3-small" onchange='general.selectChanged()'>
                        <option>All Teachers</option>
                        <!-- START teacherslist -->
                        @foreach ($teachers as $t)
                            <option value='{{$t->user_id}}'>{{$t->teachername}}</option>
                        @endforeach
                        
                        <!-- END teacherslist -->
                    </select>
                </div>
                <div class="w3-left w3-third">
                    <label class="w3-margin-left">Classes</label>
                    <select class="w3-text-red w3-select w3-small" id="selectTTClass"  name="selectTTClass" onchange='general.selectChanged()'>
                        <!-- START ttclasslist -->
                        <option value="{ID}">{name}</option>
                        <!-- END ttclasslist -->
                    </select>
                </div>
                <div class="w3-left w3-third">
                    <label class="w3-margin-left">Type</label>
                    <select class="w3-text-red w3-select w3-small" id="homeTTSelect"  name="homeTTSelect" onchange='general.selectChanged()'>
                        <!-- START tttypelist -->
                        <option value="{ID}">{name}</option>
                        <!-- END tttypelist -->
                    </select>
                </div>
            </div>

            <h3 id="tterror" class="redfont w3-center" style="display:none">--</h3>

            <div  id='periodlistlarge' class="w3-white w3-row w3-border" style="padding: 10px">
                <h4 class='w3-row'>
                    <div class='w3-left'>
                        <img src="Resources/Images/schedule.png" class="w3-margin-right" style="width:25px;margin: 3px">
                        <b id="tttitle">Year 11 Timetable</b>
                    </div>
                    
                </h4>    
                <!-- START daysofthisweek -->
                <div style="width: 13%;margin-right: 3px;" class="w3-left  w3-hide-small w3-hide-medium">
                    <h5 class="w3-margin-left w3-hide-small">{day}
                        <br><span class="w3-text-blue" style="font-size: 10px">{date}</span>
                    </h5>
                    <!-- START {day}periods -->
                    <a href="lessonperiod/{ID}?date={thedate}">
                    <div class="period w3-card  w3-hide-small w3-margin-bottom w3-{teachercolor} w3-center" style="margin: 3px;">
                        <div class="w3-small">
                            <!--{teachercolor}-->
                            <div class="w3-small">{subjectabbr}</div>
                            <div class="">{classabbr}</div>
                            <div class="w3-tiny">{fstart} - {fend}</div>
                        </div>
                    </div>
                    </a>
                    <!-- END {day}periods -->
                </div>
                <a id="{day}tt" href="#{day}ttcont" class="w3-hide-large w3-btn" onclick="$('.ttcont').hide();document.getElementById('{day}ttcont').style.display='block'" style="width: 100%">
                    <div class="w3-row w3-light-gray w3-padding w3-small w3-hide-large w3-border-blue w3-margin-bottom" style="border-left: solid blue 3px;">
                        <div class="w3-left">{day}</div>
                        <div class="w3-right">{date}</div>
                    </div>
                </a>
                <div class="w3-row ttcont w3-hide-large w3-margin-left" id="{day}ttcont" style="display: none;overflow-y: inherit; overflow-x: scroll;max-height: 80px;">
                    <!-- START {day}speriods -->
                    <a href="lessonperiod/{ID}?date={thedate}">
                    <div class="w3-left w3-border w3-margin-bottom w3-margin-right w3-hide-large">
                        <button class="w3-btn w3-hover-light-blue" onclick="">
                        <div class="w3-small" style="margin-right: 5px;padding: 5px;">
                            <div class="w3-text-green w3-small">{subjectabbr}</div>
                            <div class="w3-text-gray">{classabbr}</div>
                        </div>
                        </button>
                    </div>
                    </a>
                    <!-- END {day}speriods -->
                </div>
                <!-- END daysofthisweek -->
            </div>
        </div>
    </div>
</div>
@endsection