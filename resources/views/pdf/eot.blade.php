<!DOCTYPE html>
<html>

<head>
<title>{{$title}}</title>
<style type="text/css">
.auto-style1 {
	border-collapse: collapse;
	border: 1px solid #000000;
}
.auto-style2 {
	border: 1px solid #000000;
}
.auto-style3 {
	text-align: center;
	white-space: nowrap;
}
</style>

</head>

<body>

<table class="auto-style1" style="width: 100%; height: 1000px">
	
	<tr>
		<td class="auto-style2" colspan="4" style="height: 100px">
			<div style="width: 100%;clear:both">
				<div style="width: 25%;float:left">
					<img src="{{ public_path('halogo.jpg') }}" style="height: 80px">
				</div>
				<div style="width: 25%;float:right">
				</div>
			</div>
		</td>
	</tr>
	
	<tr>
		<td class="auto-style2" colspan="4" style="height: 60px">
		<table cellpadding="0" cellspacing="0" style="width: 100%">
			<tr>
				<td >
				<span dir="ltr" role="presentation" style="left: 10%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05885);">
				<strong>Name of student</strong></span><strong><span dir="ltr" role="presentation" style="left: 24.29%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.06907);">:
				</span></strong>
				<span dir="ltr" role="presentation" style="left: 39.91%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				<strong>&nbsp;</strong></span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.06907);">
				{{$stdname}}</span></td>
				<td>
				<span dir="ltr" role="presentation" style="left: 57.62%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0587);">
				<strong>Next term opens</strong></span><span dir="ltr" role="presentation" style="left: 71.9%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0481);"><strong>:
				</strong></span></td>
				<td>
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0481);">
				{{$nexttermopens}}</span></td>
			</tr>
			<tr>
				<td>
				<span dir="ltr" role="presentation" style="left: 10%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05138);">
				<strong>Class</strong></span><strong><span dir="ltr" role="presentation" style="left: 14.59%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span>
				<span dir="ltr" role="presentation" style="left: 24.29%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.04722);">
				: </span></strong>
				<span dir="ltr" role="presentation" style="left: 57.62%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05529);">
				<strong>&nbsp;</strong></span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.04722);">
				{{$classname}}</span><span dir="ltr" role="presentation" style="left: 41.64%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span>
				<span dir="ltr" role="presentation" style="left: 57.62%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05529);">
				</span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05529);">
				<strong>Academic year</strong></span><strong><span dir="ltr" role="presentation" style="left: 70.44%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span></strong>
				<span dir="ltr" role="presentation" style="left: 71.9%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05224);">
				<strong>: </strong></span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05224);">
				{{$accyear}}</span></td>
			</tr>
			<tr>
				<td >
				<span dir="ltr" role="presentation" style="left: 10%; top: 24.95%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.1394);">
				<strong>Term</strong></span><strong><span dir="ltr" role="presentation" style="left: 14.81%; top: 24.95%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span></strong>
				<span dir="ltr" role="presentation" style="left: 24.29%; top: 24.95%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.2438);">
				<strong>: </strong></span></td>
				<td  colspan="3">{{$term}}</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="auto-style2" colspan="4" style="height: 70px">
		<h2 class="auto-style3">
		<span dir="ltr" role="presentation" style="left: 38.31%; top: 30.46%; font-size: calc(var(--scale-factor)*16.00px); font-family: serif; transform: scaleX(1.08395);">
		SCHOOL REPORT</span></h2>
		</td>
	</tr>
	<tr>
		<td class="auto-style2">
		<h3>
		<span dir="ltr" role="presentation" style="left: 21.75%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0743);">
		Subject</span><span dir="ltr" role="presentation" style="left: 28.25%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
		</span>
		<span dir="ltr" role="presentation" style="left: 50.74%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">&nbsp;</span></h3>
		</td>
		<td class="auto-style2">
		<h3>
		<span dir="ltr" role="presentation" style="left: 41.17%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.10292);">
		Marks (%)</span></h3>
		</td>
		<td class="auto-style2" style="height: 30px">
		<h3>
		<span dir="ltr" role="presentation" style="left: 52.73%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.11367);">
		Grade</span><span dir="ltr" role="presentation" style="left: 58.22%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
		</span></h3>
		</td>
		<td class="auto-style2">
		<h3>
		<span dir="ltr" role="presentation" style="left: 60%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.06612);">
		Numerical Grading System</span></h3>
		</td>
	</tr>
    @foreach ($rows as $row)
    <tr>
		<td class="auto-style2">{{$row['subjectname']}}</td>
		<td class="auto-style2">{{$row['score']}}</td>
		<td class="auto-style2">{{$row['grade']}}</td>
		<td class="auto-style2">&nbsp;</td>
	</tr>
    @endforeach
	
	<tr>
		<td class="auto-style2" colspan="4" style="height: 50px">
		<h3 class="auto-style3"><span dir="ltr" role="presentation">GENERAL 
		COMMENT</span></h3>
		</td>
	</tr>
	<tr>
		<td class="auto-style2" colspan="4" style="height: 120px">
            <span style="text-align:center">
                {{$comment}}    
            </span>
        </td>
	</tr><tr>
		<td class="auto-style2" colspan="4" style="height: 60px">
		<span dir="ltr" role="presentation" style="left: 10%; top: 88.69%; font-size: calc(var(--scale-factor)*10.00px); font-family: serif; transform: scaleX(1.02919);">
		Hilltop Academy 2022/2023</span></td>
	</tr>
</table>

</body>

</html>
<!DOCTYPE html>
<html>

<head>
<title>{{$title}}</title>
<style type="text/css">
.auto-style1 {
	border-collapse: collapse;
	border: 1px solid #000000;
}
.auto-style2 {
	border: 1px solid #000000;
}
.auto-style3 {
	text-align: center;
	white-space: nowrap;
}
</style>

</head>

<body>

<table class="auto-style1" style="width: 100%; height: 1000px">
	
	<tr>
		<td class="auto-style2" colspan="4" style="height: 60px">
		<table cellpadding="0" cellspacing="0" style="width: 100%">
			<tr>
				<td >
				<span dir="ltr" role="presentation" style="left: 10%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05885);">
				<strong>Name of student</strong></span><strong><span dir="ltr" role="presentation" style="left: 24.29%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.06907);">:
				</span></strong>
				<span dir="ltr" role="presentation" style="left: 39.91%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				<strong>&nbsp;</strong></span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.06907);">
				{{$stdname}}</span></td>
				<td>
				<span dir="ltr" role="presentation" style="left: 57.62%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0587);">
				<strong>Next term opens</strong></span><span dir="ltr" role="presentation" style="left: 71.9%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0481);"><strong>:
				</strong></span></td>
				<td>
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0481);">
				{{$nexttermopens}}</span></td>
			</tr>
			<tr>
				<td>
				<span dir="ltr" role="presentation" style="left: 10%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05138);">
				<strong>Class</strong></span><strong><span dir="ltr" role="presentation" style="left: 14.59%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span>
				<span dir="ltr" role="presentation" style="left: 24.29%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.04722);">
				: </span></strong>
				<span dir="ltr" role="presentation" style="left: 57.62%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05529);">
				<strong>&nbsp;</strong></span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.04722);">
				{{$classname}}</span><span dir="ltr" role="presentation" style="left: 41.64%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span>
				<span dir="ltr" role="presentation" style="left: 57.62%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05529);">
				</span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05529);">
				<strong>Academic year</strong></span><strong><span dir="ltr" role="presentation" style="left: 70.44%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span></strong>
				<span dir="ltr" role="presentation" style="left: 71.9%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05224);">
				<strong>: </strong></span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05224);">
				{{$accyear}}</span></td>
			</tr>
			<tr>
				<td >
				<span dir="ltr" role="presentation" style="left: 10%; top: 24.95%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.1394);">
				<strong>Term</strong></span><strong><span dir="ltr" role="presentation" style="left: 14.81%; top: 24.95%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span></strong>
				<span dir="ltr" role="presentation" style="left: 24.29%; top: 24.95%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.2438);">
				<strong>: </strong></span></td>
				<td  colspan="3">{{$term}}</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="auto-style2" colspan="4" style="height: 70px">
		<h2 class="auto-style3">
		<span dir="ltr" role="presentation" style="left: 38.31%; top: 30.46%; font-size: calc(var(--scale-factor)*16.00px); font-family: serif; transform: scaleX(1.08395);">
		SCHOOL REPORT</span></h2>
		</td>
	</tr>
	<tr>
		<td class="auto-style2">
		<h3>
		<span dir="ltr" role="presentation" style="left: 21.75%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0743);">
		Subject</span><span dir="ltr" role="presentation" style="left: 28.25%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
		</span>
		<span dir="ltr" role="presentation" style="left: 50.74%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">&nbsp;</span></h3>
		</td>
		<td class="auto-style2">
		<h3>
		<span dir="ltr" role="presentation" style="left: 41.17%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.10292);">
		Marks (%)</span></h3>
		</td>
		<td class="auto-style2" style="height: 30px">
		<h3>
		<span dir="ltr" role="presentation" style="left: 52.73%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.11367);">
		Grade</span><span dir="ltr" role="presentation" style="left: 58.22%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
		</span></h3>
		</td>
		<td class="auto-style2">
		<h3>
		<span dir="ltr" role="presentation" style="left: 60%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.06612);">
		Numerical Grading System</span></h3>
		</td>
	</tr>
    @foreach ($rows as $row)
    <tr>
		<td class="auto-style2">{{$row['subjectname']}}</td>
		<td class="auto-style2">{{$row['score']}}</td>
		<td class="auto-style2">{{$row['grade']}}</td>
		<td class="auto-style2">&nbsp;</td>
	</tr>
    @endforeach
	
	<tr>
		<td class="auto-style2" colspan="4" style="height: 50px">
		<h3 class="auto-style3"><span dir="ltr" role="presentation">GENERAL 
		COMMENT</span></h3>
		</td>
	</tr>
	<tr>
		<td class="auto-style2" colspan="4" style="height: 120px">
            <span style="text-align:center">
                {{$comment}}    
            </span>
        </td>
	</tr><tr>
		<td class="auto-style2" colspan="4" style="height: 60px">
		<span dir="ltr" role="presentation" style="left: 10%; top: 88.69%; font-size: calc(var(--scale-factor)*10.00px); font-family: serif; transform: scaleX(1.02919);">
		Hilltop Academy 2022/2023</span></td>
	</tr>
</table>

</body>

</html>
<!DOCTYPE html>
<html>

<head>
<title>{{$title}}</title>
<style type="text/css">
.auto-style1 {
	border-collapse: collapse;
	border: 1px solid #000000;
}
.auto-style2 {
	border: 1px solid #000000;
}
.auto-style3 {
	text-align: center;
	white-space: nowrap;
}
</style>

</head>

<body>

<table class="auto-style1" style="width: 100%; height: 1000px">
	
	<tr>
		<td class="auto-style2" colspan="4" style="height: 60px">
			<div style="width: 100%;clear:both">
				<div style="width: 25%;float:left">
					<img src="{{ public_path('halogo.jpg') }}" style="width: 80px; height: 80px">
				</div>
				<div style="width: 25%;float:right">
				</div>
			</div>
		</td>
	</tr>
	
	<tr>
		<td class="auto-style2" colspan="4" style="height: 60px">
		<table cellpadding="0" cellspacing="0" style="width: 100%">
			<tr>
				<td >
				<span dir="ltr" role="presentation" style="left: 10%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05885);">
				<strong>Name of student</strong></span><strong><span dir="ltr" role="presentation" style="left: 24.29%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.06907);">:
				</span></strong>
				<span dir="ltr" role="presentation" style="left: 39.91%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				<strong>&nbsp;</strong></span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.06907);">
				{{$stdname}}</span></td>
				<td>
				<span dir="ltr" role="presentation" style="left: 57.62%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0587);">
				<strong>Next term opens</strong></span><span dir="ltr" role="presentation" style="left: 71.9%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0481);"><strong>:
				</strong></span></td>
				<td>
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0481);">
				{{$nexttermopens}}</span></td>
			</tr>
			<tr>
				<td>
				<span dir="ltr" role="presentation" style="left: 10%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05138);">
				<strong>Class</strong></span><strong><span dir="ltr" role="presentation" style="left: 14.59%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span>
				<span dir="ltr" role="presentation" style="left: 24.29%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.04722);">
				: </span></strong>
				<span dir="ltr" role="presentation" style="left: 57.62%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05529);">
				<strong>&nbsp;</strong></span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.04722);">
				{{$classname}}</span><span dir="ltr" role="presentation" style="left: 41.64%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span>
				<span dir="ltr" role="presentation" style="left: 57.62%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05529);">
				</span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05529);">
				<strong>Academic year</strong></span><strong><span dir="ltr" role="presentation" style="left: 70.44%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span></strong>
				<span dir="ltr" role="presentation" style="left: 71.9%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05224);">
				<strong>: </strong></span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05224);">
				{{$accyear}}</span></td>
			</tr>
			<tr>
				<td >
				<span dir="ltr" role="presentation" style="left: 10%; top: 24.95%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.1394);">
				<strong>Term</strong></span><strong><span dir="ltr" role="presentation" style="left: 14.81%; top: 24.95%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span></strong>
				<span dir="ltr" role="presentation" style="left: 24.29%; top: 24.95%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.2438);">
				<strong>: </strong></span></td>
				<td  colspan="3">{{$term}}</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="auto-style2" colspan="4" style="height: 70px">
		<h2 class="auto-style3">
		<span dir="ltr" role="presentation" style="left: 38.31%; top: 30.46%; font-size: calc(var(--scale-factor)*16.00px); font-family: serif; transform: scaleX(1.08395);">
		SCHOOL REPORT</span></h2>
		</td>
	</tr>
	<tr>
		<td class="auto-style2">
		<h3>
		<span dir="ltr" role="presentation" style="left: 21.75%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0743);">
		Subject</span><span dir="ltr" role="presentation" style="left: 28.25%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
		</span>
		<span dir="ltr" role="presentation" style="left: 50.74%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">&nbsp;</span></h3>
		</td>
		<td class="auto-style2">
		<h3>
		<span dir="ltr" role="presentation" style="left: 41.17%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.10292);">
		Marks (%)</span></h3>
		</td>
		<td class="auto-style2" style="height: 30px">
		<h3>
		<span dir="ltr" role="presentation" style="left: 52.73%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.11367);">
		Grade</span><span dir="ltr" role="presentation" style="left: 58.22%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
		</span></h3>
		</td>
		<td class="auto-style2">
		<h3>
		<span dir="ltr" role="presentation" style="left: 60%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.06612);">
		Numerical Grading System</span></h3>
		</td>
	</tr>
    @foreach ($rows as $row)
    <tr>
		<td class="auto-style2">{{$row['subjectname']}}</td>
		<td class="auto-style2">{{$row['score']}}</td>
		<td class="auto-style2">{{$row['grade']}}</td>
		<td class="auto-style2">&nbsp;</td>
	</tr>
    @endforeach
	
	<tr>
		<td class="auto-style2" colspan="4" style="height: 50px">
		<h3 class="auto-style3"><span dir="ltr" role="presentation">GENERAL 
		COMMENT</span></h3>
		</td>
	</tr>
	<tr>
		<td class="auto-style2" colspan="4" style="height: 120px">
            <span style="text-align:center">
                {{$comment}}    
            </span>
        </td>
	</tr><tr>
		<td class="auto-style2" colspan="4" style="height: 60px">
		<span dir="ltr" role="presentation" style="left: 10%; top: 88.69%; font-size: calc(var(--scale-factor)*10.00px); font-family: serif; transform: scaleX(1.02919);">
		Hilltop Academy 2022/2023</span></td>
	</tr>
</table>

</body>

</html>
<!DOCTYPE html>
<html>

<head>
<title>{{$title}}</title>
<style type="text/css">
.auto-style1 {
	border-collapse: collapse;
	border: 1px solid #000000;
}
.auto-style2 {
	border: 1px solid #000000;
}
.auto-style3 {
	text-align: center;
	white-space: nowrap;
}
</style>

</head>

<body>

<table class="auto-style1" style="width: 100%; height: 1000px">
	
	<tr>
		<td class="auto-style2" colspan="4" style="height: 60px">
		<table cellpadding="0" cellspacing="0" style="width: 100%">
			<tr>
				<td >
				<span dir="ltr" role="presentation" style="left: 10%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05885);">
				<strong>Name of student</strong></span><strong><span dir="ltr" role="presentation" style="left: 24.29%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.06907);">:
				</span></strong>
				<span dir="ltr" role="presentation" style="left: 39.91%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				<strong>&nbsp;</strong></span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.06907);">
				{{$stdname}}</span></td>
				<td>
				<span dir="ltr" role="presentation" style="left: 57.62%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0587);">
				<strong>Next term opens</strong></span><span dir="ltr" role="presentation" style="left: 71.9%; top: 20.91%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0481);"><strong>:
				</strong></span></td>
				<td>
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0481);">
				{{$nexttermopens}}</span></td>
			</tr>
			<tr>
				<td>
				<span dir="ltr" role="presentation" style="left: 10%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05138);">
				<strong>Class</strong></span><strong><span dir="ltr" role="presentation" style="left: 14.59%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span>
				<span dir="ltr" role="presentation" style="left: 24.29%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.04722);">
				: </span></strong>
				<span dir="ltr" role="presentation" style="left: 57.62%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05529);">
				<strong>&nbsp;</strong></span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.04722);">
				{{$classname}}</span><span dir="ltr" role="presentation" style="left: 41.64%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span>
				<span dir="ltr" role="presentation" style="left: 57.62%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05529);">
				</span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05529);">
				<strong>Academic year</strong></span><strong><span dir="ltr" role="presentation" style="left: 70.44%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span></strong>
				<span dir="ltr" role="presentation" style="left: 71.9%; top: 22.93%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05224);">
				<strong>: </strong></span></td>
				<td >
				<span dir="ltr" role="presentation" style="font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.05224);">
				{{$accyear}}</span></td>
			</tr>
			<tr>
				<td >
				<span dir="ltr" role="presentation" style="left: 10%; top: 24.95%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.1394);">
				<strong>Term</strong></span><strong><span dir="ltr" role="presentation" style="left: 14.81%; top: 24.95%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
				</span></strong>
				<span dir="ltr" role="presentation" style="left: 24.29%; top: 24.95%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.2438);">
				<strong>: </strong></span></td>
				<td  colspan="3">{{$term}}</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="auto-style2" colspan="4" style="height: 70px">
		<h2 class="auto-style3">
		<span dir="ltr" role="presentation" style="left: 38.31%; top: 30.46%; font-size: calc(var(--scale-factor)*16.00px); font-family: serif; transform: scaleX(1.08395);">
		SCHOOL REPORT</span></h2>
		</td>
	</tr>
	<tr>
		<td class="auto-style2">
		<h3>
		<span dir="ltr" role="presentation" style="left: 21.75%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.0743);">
		Subject</span><span dir="ltr" role="presentation" style="left: 28.25%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
		</span>
		<span dir="ltr" role="presentation" style="left: 50.74%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">&nbsp;</span></h3>
		</td>
		<td class="auto-style2">
		<h3>
		<span dir="ltr" role="presentation" style="left: 41.17%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.10292);">
		Marks (%)</span></h3>
		</td>
		<td class="auto-style2" style="height: 30px">
		<h3>
		<span dir="ltr" role="presentation" style="left: 52.73%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.11367);">
		Grade</span><span dir="ltr" role="presentation" style="left: 58.22%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif;">
		</span></h3>
		</td>
		<td class="auto-style2">
		<h3>
		<span dir="ltr" role="presentation" style="left: 60%; top: 35.22%; font-size: calc(var(--scale-factor)*12.00px); font-family: serif; transform: scaleX(1.06612);">
		Numerical Grading System</span></h3>
		</td>
	</tr>
    @foreach ($rows as $row)
    <tr>
		<td class="auto-style2">{{$row['subjectname']}}</td>
		<td class="auto-style2">{{$row['score']}}</td>
		<td class="auto-style2">{{$row['grade']}}</td>
		<td class="auto-style2">&nbsp;</td>
	</tr>
    @endforeach
	
	<tr>
		<td class="auto-style2" colspan="4" style="height: 50px">
		<h3 class="auto-style3"><span dir="ltr" role="presentation">GENERAL 
		COMMENT</span></h3>
		</td>
	</tr>
	<tr>
		<td class="auto-style2" colspan="4" style="height: 120px">
            <span style="text-align:center">
                {{$comment}}    
            </span>
        </td>
	</tr><tr>
		<td class="auto-style2" colspan="4" style="height: 60px">
		<span dir="ltr" role="presentation" style="left: 10%; top: 88.69%; font-size: calc(var(--scale-factor)*10.00px); font-family: serif; transform: scaleX(1.02919);">
		Hilltop Academy 2022/2023</span></td>
	</tr>
</table>

</body>

</html>
