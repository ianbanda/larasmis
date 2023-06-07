@extends('main')
@section('title', 'Classes')
@section('content')


    <div class=" exams ">
        <div class="w3-grey w3-text-white w3-hide-small">
            <h1 class="w3-margin w3-row">
                <span class="w3-left">Class List</span>
                <button class="w3-btn w3-small w3-green w3-margin w3-round-large w3-right"  onclick="document.getElementById('newClassModal').style.display='block'">+ Create New</button>
            </h1>
        </div>
    <div class="">

        <h2 class="redfont w3-padding">
            <b class="">Classes</b>
            <a href="system/privileges" class="w3-right w3-btn w3-round-large blueborder w3-white w3-card w3-large w3-hide-small w3-margin"><b>System Privileges</b></a>
        </h2>

    </div>
        <div class="search w3-row w3-margin-bottom w3-hide-small">
            <input class="w3-input w3-padding w3-margin" placeholder="Search Classes" />
        </div>
        <div id='classlist' class="w3-white w3-margin"  style="max-height:500px;overflow: auto">
            <ul class="w3-ul exams w3-margin-0"  style="margin: 0px;padding:0px;">
                @foreach ($classes as $class)
                <li class="w3-tiny w3-margin-0" style="margin: 0px;padding:0px">
                    <div class="exam w3-cell-row">
                        <div class="w3-col w3-center w3-margin-top" style="width:50px">
                            <h4 class="w3-margin-right"><b>{{$class->abbr}}</b></h4>
                        </div>
                        <div class="w3-rest w3-margin-0">
                            <h6 class="w3-text-grey w3-small"><a href='classes/view?client=android&classid={{$class->ID}}' style="color:#4c91d4"><b>{{$class->name}}</b></a></h6>
                            <div class="w3-row">
                                <div class="w3-left">
                                    <div class="w3-text-grey w3-row">
                                        <div class="w3-left w3-margin-right"><b>Stds</b>&nbsp;&nbsp; <span class="w3-text-green">{{$class->numofstudents}}</span></div>
                                        <div class="w3-left w3-margin-right"><b>Trs</b>: {{$class->numofteachers}}</div>
                                        <div class="w3-left w3-margin-0">
                                            <b>Term :</b> <span class="w3-text-green">{{$class->termname}}</span>
                                        </div>
                                    </div>                        
                                </div>
                            </div>     
                        </div>                       
                    </div>
                </li>
                @endforeach
            </ul>  
        </div>
    </div>

    <!-- Modals -->
    <!-- Exam List Modal -->
    <div id="examsModal" class="w3-modal">
        <div class="w3-modal-content w3-light-gray">
            <div class="w3-container">
                <span onclick="document.getElementById('examsModal').style.display='none'"
                    class="w3-button w3-display-topright">&times;</span>
                    <div class="">
                        <div class="w3-text-grey">
                            <h1>English Scores</h1>
                            <h6>Year 11 Science </h6>
                        </div>
                        
                    </div>
            </div>
        </div>
    </div>
    <!-- New Class Modal -->
    <div id="newClassModal" class="w3-modal">
        <div class="w3-modal-content w3-light-gray">
            <div class="w3-container">
                <span onclick="document.getElementById('newClassModal').style.display='none'"
                    class="w3-button w3-display-topright">&times;</span>
                    <div class="">
            <div class="w3-text-grey">
                <h1>Create New Class</h1>
                <h6>Classes </h6>
            </div>
            <div class='w3-white w3-margin'>
                <div class="w3-margin">
                    <br>
                    <div class="w3-light-gray w3-round w3-border w3-padding w3-row w3-margin-top w3-text-grey">
                        <div class="w3-row w3-margin-bottom">
                            <div class="">Name</div>
                            <input class="w3-select w3-white" name='name' />
                                
                        </div>
                        <div class="w3-row w3-margin-bottom">
                            <div class="w3-left">Term</div>
                            <div class=" w3-margin-left w3-left">
                            <select class="w3-select w3-white" name='term'>
                                <!-- START terms -->
                                <option value="{ID}">{name}</option>
                                
                                <!-- END terms -->
                            </select>
                            </div>
                        </div>
                        <div class="w3-row w3-margin-bottom">
                            <div class="w3-left">Level</div>
                            <div class=" w3-margin-left w3-left">
                            <select class="w3-select w3-white" name='level'>
                                <!-- START levels -->
                                <option value="{ID}">{level}</option>
                                <!-- END levels -->
                            </select>
                            </div>
                        </div>
                        <div class="w3-row w3-margin-bottom">
                            <div class="w3-left">Subdivision</div>
                            <div class=" w3-margin-left w3-left">
                            <select class="w3-select w3-white" name='subdivision'>
                            <!-- START subdivisions -->
                            <option value="{ID}">{name}</option>
                                <!-- END subdivisions -->
                            </select>
                            </div>
                        </div>
                        <div class="w3-row w3-margin">
                            <button class="w3-btn w3-right w3-grey" onclick="saveNewClass()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
            </div>
        </div>
    </div>


@endsection