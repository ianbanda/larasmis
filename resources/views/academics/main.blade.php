@extends('main')
@section('title', 'Academics')
@section('content')

<div class="w3-container" style="width:80%;margin-left:auto;margin-right:auto;">
    <div class="redfont">
        <h1><b>Academics @isset($subbit)
            <span class='w3-blue-gray'>{{$subbit}}</span>
        @endisset </b></h1>
    </div>
    <div class="w3-row w3-text-grey" style="font-weight:bold">
        <div class="w3-left w3-border w3-card w3-center w3-white" style="width:30%;margin: 10px;">
            <h3 style="font-weight:bold">Exams</h3>
            <img src="{{asset('Resources/Images/academics.png')}}" class="w3-margin-bottom" /><br>
            <button class="w3-btn w3-round-xlarge w3-gray w3-margin-bottom redfont" onclick="academics.showExamCategoryModal()">Exams</button>
        </div>
        <div class="w3-left w3-border w3-card w3-center w3-white" style="width:30%;margin: 10px;">
            <h3 style="font-weight:bold">Assignments</h3>
            <img src="{{asset('Resources/Images/academics.png')}}" class="w3-margin-bottom" /><br>
            <a href="academics/assignments" class="w3-btn w3-round-xlarge redfont w3-gray w3-margin-bottom">Assignments</a>
        </div>
        <div class="w3-right w3-border w3-card w3-center w3-white" style="width:30%;margin: 10px;">
            <h3 style="font-weight:bold">Settings</h3>
            <img src="{{asset('Resources/Images/edit.png')}}" class="w3-margin-bottom" /><br>
            <a href="academics/assignments" class="w3-btn w3-round-xlarge redfont w3-gray w3-margin-bottom">Settings</a>
        </div>
    </div>
</div>



<!-- The Modal -->
<div id="examTypeLinksModal" class="w3-modal w3-round w3-card">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('examTypeLinksModal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <div id='classAttModalCont'>
        <div class='w3-row w3-tiny w3-text-grey'>
            
            <div class='w3-padding' id='camrc'>
                <br>
                <h3 class="w3-center"><b class="w3-text-blue w3-margin-bottom">
                    <a href="#" class="w3-btn w3-round-large w3-blue w3-margin-bottom">Examination / Test Category</a></b><br> 
                </h3>
                <br>
                <div class="w3-margin-bottom" style="max-height:100px;">
                    <ul id="classAttendanceStdList" class="w3-ul">
                        <a href="{bits}academics/exams?catid=all">
                        <li class="w3-row w3-third w3-padding">
                            <div class="w3-border w3-round-large">
                                <h1 class="w3-border-bottom w3-text-grey w3-center"><b>All</b></h1> 
                                <div class="w3-center redfont">All Categories</div>
                            </div>
                        </li>
                        </a>
                        <!-- START examcatlist -->
                        <a href="{bits}academics/exams?catid={ID}&catname={name}">
                        <li class="w3-row w3-third w3-padding">
                            <div class="w3-border w3-round-large">
                                <h1 class="w3-border-bottom w3-text-grey w3-center"><b>{abbr}</b></h1> 
                                <div class="w3-center redfont">{name}</div>
                            </div>
                        </li>
                        </a>
                        <!-- END examcatlist -->
                    </ul>
                    <br>
                </div>
                <br>
            </div>
            <br>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection