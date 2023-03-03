@extends('main')
@section('title', 'Classes')
@section('content')


    <div class=" exams">
        <div class="w3-grey w3-text-white">
            <h1 class="w3-margin w3-row">
                <span class="w3-left">Class List</span>
                <button class="w3-btn w3-small w3-green w3-margin w3-round-large w3-right"  onclick="document.getElementById('newClassModal').style.display='block'">+ Create New</button>
            </h1>
        </div>
    <div class="">

    </div>
        <div class="search w3-row w3-margin-bottom">
            <input class="w3-input w3-padding w3-margin" placeholder="Search Classes" />
        </div>
        <div id='classlist' class="w3-white w3-margin"  style="max-height:400px;overflow: auto">
            <ul class="w3-ul exams w3-margin">
                
                @foreach ($classes as $class)
                <li>
                    <div class="exam w3-row">
                        <img class="w3-left icon w3-margin-right" src="Views/default/images/exam.png" />
                        <div class="w3-left">
                            <div class="w3-text-green w3-large">{{$class->name}}</div>                        
                            <div class="w3-text-grey w3-small w3-row">
                                <div class="w3-left w3-margin"><b># of Students</b>&nbsp;&nbsp; <span class="w3-text-green">{numofstudents}</span></div>
                                <div class="w3-left w3-margin"><b>Teachers</b>: {numofteachers}</div>
                                <div class="w3-left w3-margin">
                                    <b>Term :</b> <span class="w3-text-green">{termname}</span>
                                </div>
                            </div>                        
                        </div>
                        <div class="w3-right w3-margin-left">
                            <a href='classes/view?classid={{$class->ID}}' class="w3-green w3-btn w3-text-white w3-round">View Class</a>                        
                        </div>
                        <div class="w3-right">
                            <button class="w3-orange w3-btn w3-text-white w3-round">Edit Class</button>                        
                        </div>
                    </div>
                </li>
                @endforeach
                <!-- START classlist --
                <li>
                    <div class="exam w3-row">
                        <img class="w3-left icon w3-margin-right" src="Views/default/images/exam.png" />
                        <div class="w3-left">
                            <div class="w3-text-green w3-large">{name}</div>                        
                            <div class="w3-text-grey w3-small w3-row">
                                <div class="w3-left w3-margin"><b># of Students</b>&nbsp;&nbsp; <span class="w3-text-green">{numofstudents}</span></div>
                                <div class="w3-left w3-margin"><b>Teachers</b>: {numofteachers}</div>
                                <div class="w3-left w3-margin">
                                    <b>Term :</b> <span class="w3-text-green">{termname}</span>
                                </div>
                            </div>                        
                        </div>
                        <div class="w3-right w3-margin-left">
                            <a href='{bits}classes/view?classid={ID}' class="w3-green w3-btn w3-text-white w3-round">View Class</a>                        
                        </div>
                        <div class="w3-right">
                            <button class="w3-orange w3-btn w3-text-white w3-round">Edit Class</button>                        
                        </div>
                    </div>
                </li>
                <!-- END classlist -->
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

Welcome to your application dashboard!
@endsection