
    function getMessage() {
        //alert('Message');
        /*const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("msg").innerHTML = this.responseText;
            alert(this.responseText);
        }
        xhttp.open("GET", "/getmsg");
        xhttp.send();*/      
        $.get("/getmsg", function(data, status){
            //alert("Data: " + data + "\nStatus: " + status);
            for(x in data)
            {
                alert(data[x].firstname);
            }
            //var result = JSON.parse(data);
            //alert("result: " + result);
        });         
    }

    var general = {
        object: "",
        query : "",
        inarray:function(value,array)
        {
            var status = false;
            for(var i =0; i<array.length;i++)
            {
                //alert(array[i]);
                var val = array[i];
                if(val == value)
                {
                    //alert("found");
                    status = true;
                    break;
                }
            }

            return status;
        },
        animateValue:function(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                obj.innerHTML = Math.floor(progress * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
          window.requestAnimationFrame(step);
        },
        checkboxChanged:function(){
            var cb = event.target;
            var name;
            var attr = $(cb).attr('name');

            // For some browsers, `attr` is undefined; for others,
            // `attr` is false.  Check for both.
            if (typeof attr !== 'undefined' && attr !== false) {
                name = $(cb).attr("name");
            }
            else {
                name = $(cb).attr("class");
            }
            //alert(name);
            switch(name)
            {
                case "allsmrowscb":
                    var checkBoxes = $('.entiresmrowcb, td.stdsubtd input');
                    checkBoxes.prop("checked", !checkBoxes.prop("checked"));
                    $(this).prop("checked", checkBoxes.is(':checked'));
                    
                    break;
                case "entiresmrowcb":
                    var stdid = $(cb).attr("stdid");

                    var checkBoxes = $(".stdsubcb"+stdid);
                    if($(cb).prop("checked"))
                    {
                        //$(checkBoxes).hide();
                        $(checkBoxes).prop("checked", true);
                        $(checkBoxes).prop("checked", "checked");
                    }else
                    {
                        $(checkBoxes).prop("checked", false);
                    }


                    $(this).prop("checked", checkBoxes.is(':checked'));

                    break;
                
            }
        },
        selectChanged: function () {
            var select = event.target;
            var name = $(select).attr("name");
            var bits = $('#bits').attr('class');
            this.query += bits;
            //alert("The Name : "+$(select).attr("name"));
           
            switch(name)
            {
                case "stdtakingsubSelect":// Subject paper result contribution Term Select
                    var classid = $("#classid").attr('class');
                    var subjectid = $("#stdtakingsubSelect option:selected").val();
                    stdclass.loadSubjectStdTakingStats(classid,subjectid);
                    break;
                    
                case "spcTermSelect":// Subject paper result contribution Term Select
                    $("#termText").html($("#spcTermSelect option:selected").html());
                    var termid = $("#spcTermSelect option:selected").val();
                    $("#classText").html($("#spaClassSelect option:selected").html());
                    var classid = $("#spaClassSelect option:selected").val();
                    $("#examTypeText").html($("#spaExamTypeSelect option:selected").html());
                    var typeid = $("#spaExamTypeSelect option:selected").val();
                    $("#subjectText").html($("#spaSubjectSelect option:selected").html());
                    var subjecid = $("#spaSubjectSelect option:selected").val();
                    exams.loadSubContPapers(termid,classid,subjecid,typeid);
                    break;
                    
                case "spaExamTypeSelect":// Subject paper result contribution Term Select
                    $("#termText").html($("#spcTermSelect option:selected").html());
                    var termid = $("#spcTermSelect option:selected").val();
                    $("#classText").html($("#spaClassSelect option:selected").html());
                    var classid = $("#spaClassSelect option:selected").val();
                    $("#examTypeText").html($("#spaExamTypeSelect option:selected").html());
                    var typeid = $("#spaExamTypeSelect option:selected").val();
                    $("#subjectText").html($("#spaSubjectSelect option:selected").html());
                    var subjecid = $("#spaSubjectSelect option:selected").val();
                    exams.loadSubContPapers(termid,classid,subjecid,typeid);

                    break;
                case "spaClassSelect":// Subject paper result contribution Term Select
                    $("#termText").html($("#spcTermSelect option:selected").html());
                    var termid = $("#spcTermSelect option:selected").val();
                    $("#classText").html($("#spaClassSelect option:selected").html());
                    var classid = $("#spaClassSelect option:selected").val();
                    $("#examTypeText").html($("#spaExamTypeSelect option:selected").html());
                    var typeid = $("#spaExamTypeSelect option:selected").val();
                    $("#subjectText").html($("#spaSubjectSelect option:selected").html());
                    var subjecid = $("#spaSubjectSelect option:selected").val();
                    exams.loadSubContPapers(termid,classid,subjecid,typeid);

                    break;
                case "spaSubjectSelect":// Subject paper result contribution Term Select
                    $("#termText").html($("#spcTermSelect option:selected").html());
                    var termid = $("#spcTermSelect option:selected").val();
                    $("#classText").html($("#spaClassSelect option:selected").html());
                    var classid = $("#spaClassSelect option:selected").val();
                    $("#examTypeText").html($("#spaExamTypeSelect option:selected").html());
                    var typeid = $("#spaExamTypeSelect option:selected").val();
                    $("#subjectText").html($("#spaSubjectSelect option:selected").html());
                    var subjecid = $("#spaSubjectSelect option:selected").val();
                    exams.loadSubContPapers(termid,classid,subjecid,typeid);

                    break;

                case "selectEOTRepTerm":// EOT Report Term Select
                    var term = $("#selectEOTRepTerm option:selected").val();
                    //alert(term);
                    var classid = $("#selectEOTrepClass option:selected").val();
                    reports.loadStudents(term,classid);
                    break;

                case "selectEOTRepClass":// EOT Report Class Select
                    var classid = $("#selectEOTRepClass option:selected").val();
                    var term = $("#selectEOTRepTerm option:selected").val();
                    //alert(term);
                    reports.loadStudents(term,classid);
                    break;
                    
                case "selectTTClass":// New Teaching Timetable Class Select
                    //var color = $("select[name='"+name+"']").text();
                    //var classes = teacher.getClassesTaught();
                    var option = $("#selectTTClass option:selected").text();
                    //alert("this");
                    $('#periodlistlarge').html('<h4><b id="tttitle">Timetable</b></h4>');
                    $("#tttitle").text(option+" Timetable");
                    var type = $("#homeTTSelect option:selected").text();
                    timetables.loadClassTimetable(type);
                    $("#tttitle").text(option+" Timetable");
                    //$('#tcolorprev').html(color);
                    //$('#tcolorprev').attr('class',color);
                    break;
                    
                case "teachersTTselect":// New Teaching Timetable Class Select
                    //var color = $("select[name='"+name+"']").text();
                    //var classes = teacher.getClassesTaught();
                    var option = $("#selectTTClass option:selected").text();
                    //alert(option);
                    $('#periodlistlarge').html('<h4><b id="tttitle">Timetable</b></h4>');
                    $("#tttitle").text(option+" Timetable");
                    var type = $("#homeTTSelect option:selected").text();
                    timetables.loadClassTimetable(type);
                    $("#tttitle").text(option+" Timetable");
                    //$('#tcolorprev').html(color);
                    //$('#tcolorprev').attr('class',color);
                    break;

                case "homeTTSelect":// New Teaching Timetable Class Select
                    //var color = $("select[name='"+name+"']").text();
                    //var classes = teacher.getClassesTaught();
                    var option = $("#homeTTSelect option:selected").text();
                    //alert(option);
                    $('#periodlistlarge').html('<h4><b id="tttitle">Timetable</b></h4>');
                    $("#tttitle").text(option+" Timetable");
                    timetables.loadClassTimetable(option);
                    $("#tttitle").text(option+" Timetable");
                    //alert(option);
                    //$('#tcolorprev').html(color);
                    //$('#tcolorprev').attr('class',color);
                    break;
                case "newTTPeriodClass":// New Teaching Timetable Class Select
                    //var color = $("select[name='"+name+"']").text();
                    var classes = teacher.getClassesTaught();
                    //$('#tcolorprev').html(color);
                    //$('#tcolorprev').attr('class',color);
                    break;
                case "teacherColor":
                    var color = $("select[name='"+name+"']").text();
                    //$('#tcolorprev').html(color);
                    //$('#tcolorprev').attr('class',color);
                    break;
                case "classlevel":
                    this.query = "lib/classes/classes.php?action=list&filter=1";
                    this.object = {
                        value:$("select[name='"+name+"']").val()
                    };
                    break;
                case "class":
                    //;
                    this.query = "lib/classes/classes.php?action=listclasssubjects&filter=1";
                    this.object = {
                        value:$("select[name='"+name+"']").val()
                    };
                    break;

                case "selectEPSubject":
                    var bits = $('#bits').attr('class');
                    
                    
                    var classid = $("select[name='selectEPClass']").val();
                    var subjectid = $("select[name='"+name+"']").val();
                    var filter = "&classid="+classid+"&subjectid="+subjectid;
                    var bits = $('#bits').attr('class');
                    this.query = bits+"lib/exams/exams.php?action=list&filter=1"+filter;
                    this.object = {
                        classid:classid,
                        subjectid:subjectid
                    };
                    break;

                case "selectEPClass":
                    var bits = $('#bits').attr('class');
                    
                    
                    var classid = $("select[name='selectEPClass']").val();
                    var subjectid = $("select[name='selectEPSubject']").val();
                    var filter = "&classid="+classid+"&subjectid="+subjectid;
                    var bits = $('#bits').attr('class');
                    this.query = bits+"lib/exams/exams.php?action=list&filter=1"+filter;
                    this.object = {
                        classid:classid,
                        subjectid:subjectid
                    };
                    break;

                case "assigclass":
                    
                    var classid = $("select[name='assigclass']").val();
                    var subjectid = $("select[name='assigsubject']").val();
                    var filter = "&classid="+classid+"&subjectid="+subjectid;
                    var bits = $('#bits').attr('class');
                    this.query = bits+"lib/assignments/assignments.php?action=list&filter=1"+filter;
                    this.object = {
                        classid:classid,
                        subjectid:subjectid
                    };
                    break;

                case "assigsubject":
                    
                    var classid = $("select[name='assigclass']").val();
                    var subjectid = $("select[name='"+name+"']").val();
                    var filter = "&classid="+classid+"&subjectid="+subjectid;
                    var bits = $('#bits').attr('class');
                    this.query = bits+"lib/assignments/assignments.php?action=list&filter=1"+filter;
                    this.object = {
                        classid:classid,
                        subjectid:subjectid
                    };
                    break;

                case "teachersTTselect"://Executed when the teacher's combobox is changed
                    var teacherid = $("select[name='"+name+"']").val();
                    var ttdata = timetables.fetchTeacherTimetable(teacherid,1,1);
                    timetables.showTeacherTimetable(ttdata);
                    break;

                case "newTTPeriodTeacher"://Executed when the teacher's Timetable allocation combobox is changed
                    var teacherid = $("select[name='"+name+"']").val();
                    var termid = $('#weekday').attr('term');
                    var bits = $('#bits').attr('class');
                    this.query = bits+"lib/teachers/teacher.php?action=getclasses"; 
                    this.object={
                        teacherid:teacherid,
                        termid:termid
                    };

                    var r;
                    $.post(this.query,
                        this.object,
                        function (data, status) {
                            //alert("My Data: " + data + "\nStatus: " + status);
                            result = JSON.parse(data); 
                            //subjects = r;
                            var txt = "";
                            var ctr = 0;
                            for (x in result){
                                txt += "<option value='"+result[x].classid+"' abbr='"+result[x].classabbr+"'>"+result[x].classname+"</option>";
                                ctr += 1;
                                //alert(txt);
                            }
                            $("#newTTPeriodClass").html(txt);
                        }
                    );
                    //assi

                    this.object = "";
                    this.object = {
                        teacherid : teacherid
                    };
                    var bits = $('#bits').attr('class');
                    //this.query = bits+"lib/teachers/teachers.php?action=getteachersubjects";
                              
                    var subjects = [];
                    //alert(this.query);
                    
                    break;

				case "nepClassLevel"://Executed when the new Exam Paper class level has changed
				
                    var classlevelid = $("select[name='"+name+"']").val();
                    this.object = {
                        classlevelid : classlevelid,
                        value : classlevelid
                    };
                    var bits = $('#bits').attr('class');
                    this.query = bits+"lib/classes/classes.php?action=list&value="+classlevelid+"&filter=1";
					
                    break;
            }
            //;
            
            $.post(this.query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    var result = JSON.parse(data);
                    //alert("result ok");
                    switch(name)
                    {
                        case "newTTPeriodTeacher":
                            //alert("My Data: " + data + "\nStatus: " + status);
                            //alert(result);
                            var txt = "";
                            var ctr = 0;
                            for (x in result){
                                txt += "<option value='"+result[x].subjectid+"' abbr='"+result[x].subjectabbr+"'>"+result[x].subjectname+"</option>";
                                ctr += 1;
                            }
                            $("#newTTPeriodSub").html(txt);

                            break;

                        case "classlevel":
                            
                            //alert(result);
                            var txt = "";
                            var ctr = 0;
                            for (x in result){
                                txt += "<option value='"+result[x].ID+"'>"+result[x].name+"</option>";
                                ctr += 1;
                            }
                            alert(txt);
                            if(ctr===0){
                                $("select[name='class']").html("<option>There are no classes avalaible</option>");
                            }else{
                                $("select[name='class']").html(txt);
                            }
                            break;
                        case "class":
                            var ctr = 0;
                            //alert(result);
                            var txt = "";
                            for (x in result){
                                txt += "<option value='"+result[x].ID+"'>"+result[x].name+"</option>";
                                ctr += 1;
                            }
                            
                            if(ctr===0){
                                $("select[name='subject']").html("<option>There are no subjects avalaible</option>");
                            }else{
                                $("select[name='subject']").html(txt);
                            }
                            break;
                        case "assigclass":
                            //alert("My Data: " + data + "\nStatus: " + status);
                            var ctr = 0;
                            //alert(result);
                            var txt = "";
                            for (x in result){
                                //txt += "<option value='"+result[x].ID+"'>"+result[x].name+"</option>";
                                txt += '<li>'
                                        +'<div class="Assig w3-row">'
                                            +'<div class="w3-left w3-light-gray bgpiccover" style="background-image: url({bits}Views/default/images/Assig.png);height: 50px; min-width:50px;padding: 5px;margin: 5px"></div>'
                                            +'<div class="w3-left w3-margin-left">'
                                                +'<div class=" w3-text-grey" id="paper{ID}">'+result[x].name+'</div>'                        
                                                +'<div class="redfont w3-small w3-row">'
                                                    +'<div class="w3-left w3-margin-right"><b id="classname{ID}">'+result[x].classname+'</b></div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Out Of:</b>'+result[x].outof+'</div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Due Date:</b>'+result[x].duedate+'</div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Creation Date:</b>'+result[x].datecreated+'</div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Creation By:</b>'+result[x].creatorname+'</div>'
                                                +'</div>'                        
                                            +'</div>'
                                            +'<div class="w3-right">'
                                                +'<button class="w3-orange w3-btn w3-text-white w3-round " onclick="document.getElementById(\'AssigModal\').style.display=\'block\';assignment.processAssigPaper(\'fillmarks\',\'{ID}\',\'{classid}\',\'{name}\');">Fill Marks</button>'                        
                                            +'</div>'
                                        +'</div>'
                                    +'</li>';
                                ctr += 1;

                            }

                            if(ctr<1){
                                $("#assiglist").html("txt");
                                $("#assiglist").html("<div class='w3-margin w3-padding w3-text-grey'>There are no assignments yet avalaible</div>");
                            }else{
                                $("#assiglist").html(txt);
                            }

                            break;
							
                        case "assigsubject":
                            //alert("My Data: " + data + "\nStatus: " + status);
                            var ctr = 0;
                            //alert(result);
                            var txt = "";
                            for (x in result){
                                //txt += "<option value='"+result[x].ID+"'>"+result[x].name+"</option>";
                                txt += '<li class=" w3-white w3-border w3-round w3-margin-bottom">'
                                        +'<div class="Assig w3-row">'
                                            +'<input paperid="'+result[x].ID+'" class="w3-left w3-margin-top w3-margin-right paperlistcbx" onclick="papers.selectCBX()" type="checkbox" />'
                                            +'<div class="w3-left w3-margin-left">'
                                                +'<div class="bluefont w3-small" id="paper'+result[x].ID+'">'
                                                    +'<b class="w3-margin-right w3-text-white w3-tiny w3-badge w3-padding w3-margin-bottom">'+result[x].subjectabbr+'</b>'
                                                    +'<b><a href="">'+result[x].name+'</a></b>'
                                                +'</div>'
                                                                 
                                                +'<div class="redfont w3-tiny w3-row">'
                                                    +'<div class="w3-left w3-margin-right"><b id="classname{ID}">'+result[x].classname+'</b></div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Out Of:</b>'+result[x].outof+'</div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Due Date:</b>'+result[x].duedate+'</div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Creation Date:</b>'+result[x].datecreated+'</div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Creation By:</b>'+result[x].creatorname+'</div>'
                                                +'</div>'                        
                                            +'</div>'
                                            
                                            +'<div class="w3-right">'
                                                +'<button class="w3-green w3-btn w3-text-white w3-round w3-margin-bottom" style="'+result[x].publishBtnStyle+'" onclick="assignment.processAssigPaper(\'publish\',\''+result[x].paperid+'\',\''+result[x].classid+'\',\''+result[x].name+'\');">Publish</button>'                        
                                                +'<button class="redtheme w3-btn w3-text-white w3-round" style="" onclick="document.getElementById(\'AssigModal\').style.display=\'block\';assignment.processAssigPaper(\''+result[x].fillBtnAction+'\',\''+result[x].paperid+'\',\''+result[x].classid+'\',\''+result[x].name+'\');">'+result[x].fillBtnText+'</button>'                        
                                            +'</div>'
                                        +'</div>'
                                    +'</li>';
                                ctr += 1;

                            }

                            if(ctr<1){
                                $("#assiglist").html("txt");
                                $("#assiglist").html("<div class='w3-margin w3-padding w3-text-grey'>There are no assignments yet avalaible</div>");
                            }else{
                                $("#assiglist").html(txt);
                            }

                            break;
							
							
                        case "selectEPSubject":
                            //alert("My Data: " + data + "\nStatus: " + status);
                            $("#examlist").html(data);
                            var ctr = 0;
                            //alert(result);
                            var txt = "";
                            for (x in result){
                                //txt += "<option value='"+result[x].ID+"'>"+result[x].name+"</option>";
                                txt += '<li class=" w3-white w3-border w3-round w3-margin-bottom">'
                                        +'<div class="Assig w3-row">'
                                            +'<input paperid="'+result[x].ID+'" class="w3-left w3-margin-top w3-margin-right paperlistcbx" onclick="papers.selectCBX()" type="checkbox" />'
                                            +'<div class="w3-left w3-margin-left">'
                                                +'<div class="bluefont w3-small w3-margin-bottom" id="paper'+result[x].ID+'" style="margin-bottom:10px;">'
                                                    +'<b class="w3-margin-right w3-text-white w3-tiny w3-black w3-padding w3-margin-bottom">'+result[x].subjectabbr+'</b>'
                                                    +'<b><a href="">'+result[x].name+'</a></b>'
                                                +'</div>'
                                                                 
                                                +'<div class="redfont w3-tiny w3-row">'
                                                    +'<div class="w3-left w3-margin-right"><b id="classname{ID}">'+result[x].classname+'</b></div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Out Of:</b>'+result[x].outof+'</div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Due Date:</b>'+result[x].duedate+'</div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Creation Date:</b>'+result[x].datecreated+'</div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Creation By:</b>'+result[x].creatorname+'</div>'
                                                +'</div>'                        
                                            +'</div>'
                                            
                                            +'<div class="w3-right">'
                                                +'<button class="w3-green w3-tiny w3-btn w3-text-white w3-round w3-margin-bottom" style="'+result[x].publishBtnStyle+'" onclick="assignment.processAssigPaper(\'publish\',\''+result[x].paperid+'\',\''+result[x].classid+'\',\''+result[x].name+'\');">Publish</button>'                        
                                                +'<button class="redtheme w3-tiny w3-btn w3-text-white w3-round" style="" onclick="document.getElementById(\'examsModal\').style.display=\'block\';exams.processExamPaper(\'fillmarks\',\''+result[x].paperid+'\',\''+result[x].classid+'\',\''+result[x].classname+'\',\''+result[x].name+'\');">'+result[x].fillBtnText+'</button>'                        
                                            +'</div>'
                                        +'</div>'
                                    +'</li>';
                                ctr += 1;

                            }

                            if(ctr<1){
                                $("#examlist").html("txt");
                                $("#examlist").html("<div class='w3-margin w3-padding w3-text-grey'>There are no assignments yet avalaible</div>");
                            }else{
                                $("#examlist").html(txt);
                            }

            
                            break;
							
							
                        case "selectEPClass":
                            //alert("My Data: " + data + "\nStatus: " + status);
                            $("#examlist").html(data);
                            var ctr = 0;
                            //alert(result);
                            var txt = "";
                            for (x in result){
                                //txt += "<option value='"+result[x].ID+"'>"+result[x].name+"</option>";
                                txt += '<li class=" w3-white w3-border w3-round w3-margin-bottom">'
                                        +'<div class="Assig w3-row">'
                                            +'<input paperid="'+result[x].ID+'" class="w3-left w3-margin-top w3-margin-right paperlistcbx" onclick="papers.selectCBX()" type="checkbox" />'
                                            +'<div class="w3-left w3-margin-left">'
                                                +'<div class="bluefont w3-small" id="paper'+result[x].ID+'">'
                                                    +'<b class="w3-margin-right w3-text-white w3-tiny w3-badge w3-padding w3-margin-bottom">'+result[x].subjectabbr+'</b>'
                                                    +'<b><a href="">'+result[x].name+'</a></b>'
                                                +'</div>'
                                                                 
                                                +'<div class="redfont w3-tiny w3-row">'
                                                    +'<div class="w3-left w3-margin-right"><b id="classname{ID}">'+result[x].classname+'</b></div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Out Of:</b>'+result[x].outof+'</div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Due Date:</b>'+result[x].duedate+'</div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Creation Date:</b>'+result[x].datecreated+'</div>'
                                                    +'<div class="w3-left w3-margin-right w3-text-grey"><b>Creation By:</b>'+result[x].creatorname+'</div>'
                                                +'</div>'                        
                                            +'</div>'
                                            
                                            +'<div class="w3-right">'
                                                +'<button class="w3-green w3-btn w3-text-white w3-round w3-margin-bottom" style="'+result[x].publishBtnStyle+'" onclick="assignment.processAssigPaper(\'publish\',\''+result[x].paperid+'\',\''+result[x].classid+'\',\''+result[x].name+'\');">Publish</button>'                        
                                                +'<button class="redtheme w3-btn w3-text-white w3-round" style="" onclick="document.getElementById(\'AssigModal\').style.display=\'block\';assignment.processAssigPaper(\''+result[x].fillBtnAction+'\',\''+result[x].paperid+'\',\''+result[x].classid+'\',\''+result[x].name+'\');">'+result[x].fillBtnText+'</button>'                        
                                            +'</div>'
                                        +'</div>'
                                    +'</li>';
                                ctr += 1;

                            }

                            if(ctr<1){
                                $("#examlist").html("txt");
                                $("#examlist").html("<div class='w3-margin w3-padding w3-text-grey'>There are no Exams/Tests yet avalaible</div>");
                            }else{
                                $("#examlist").html(txt);
                            }

            
                            break;
							
						case "nepClassLevel":

							var txt = "";
							var ctr = 0;
							for (x in result){
                                txt += "<div class='w3-left w3-margin-right w3-small'>"+result[x].name+"&nbsp;<input class='' type='checkbox' name='nepClasses[]' value="+result[x].id+" /></div>";
                                ctr += 1;
                            }
							if(ctr<1){
								$("#nepClassesDIV").html("");
							}
							else{
								$("#nepClassesDIV").html(txt);
							}
							break;
                    }
                });
         
             
        }
    };
    
    var exams = {
        object: "John",
		
        processExamPaper: function (action,examid,classid,classname,papername) {
            //alert(action+examid);
			
			
            var query="";
			var bits = $('#bits').attr('class');

            switch(action)
            {
				case "viewEP"://Create query for exam score filling

					var epname = $(event.target).attr("papername");
					var epclname = $(event.target).attr("paperclass");
					$("#modalPaperName").html(epname);
					$("#modalPaperClass").html(epclname);
					
					query = bits+"lib/exams/exams.php?action=fetchEPObject&classid="+classid;
					this.object = {
						paperid:examid
					};
					break;
					
				case "viewQuestion"://Create query for exam score filling

					var questionid = $(event.target).attr("questionid");
					var epclname = $(event.target).attr("paperclass");
					$("#modalPaperName").html(epname);
					$("#modalPaperClass").html(epclname);
					
					query = bits+"lib/exams/exams.php?action=fetchEPObject&classid="+classid;
					this.object = {
						paperid:examid
					};
					break;
					
				case "fillmarks"://Create query for exam score filling
				
					var epname = $(event.target).attr("papername");
					var epclname = $(event.target).attr("paperclass");
					$("#modalFPaperName").html(epname);
					//alert(epclname);
					$("#modalFPaperClass").html(epclname);
					
                   this.query = bits+"lib/exams/exams.php?action=getcandidates&classid="+classid;
					
                    this.object = {
                        //value:$("select[name='"+name+"']").val(),
                        paperid:examid
                    };
                    break;
                    
                case "submitmarks":
                    var inputs = $("#stdlist").children('input');
                    query = bits+"lib/exams/exams.php?action=submitmarks&classid="+classid;
					
					var scores;
					var scoresArray = [];
					
                    var ctr = 0;
                    $("#stdlist :input").each(function()
						{
                            if($(this).is(":visible")){
                                ctr++;
                                //alert(ctr);
                                var scoreid = $(this).attr("scoreid");
                                var stdid = $(this).attr("stdid");
                                var paperid = $(this).attr("paperid");
                                var score = $(this).val();
                                
                                if(score>=0){
                                    scoresArray.push({id:scoreid,studentid:stdid,paper:paperid,scorevalue:score});
                                }	
                            }						
						}
					);
					
					this.object = {scores:scoresArray};
                    
                    break;
                
            }
         
         //alert(this.query);
            $.post(this.query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    var result = JSON.parse(data);
                    switch(action)
                    {
						case "viewEP":
							//alert(result);
                            var txt = "";
                            var ctr = 0;
                            for (x in result){
								if(result[x].level === 1)
								{
									txt += '<div id="question'+result[x].id+'" class="w3-border-light-gray w3-border w3-margin-top w3-hide-small" style="padding:5px;">'
												+'<div class="w3-light-gray w3-row w3-padding">'
													+'<div class="w3-left w3-text-grey" style="height: 50px; font-weight:bold; min-width:50px;padding: 5px;margin:5px">'
														+'<b><h1>'+result[x].number+'.</h1></b>'
													+'</div>'
													+'<div class="w3-margin-left bluefont w3-left">'
														+'<h4 class="w3-small">'+result[x].topicname+'</h4>'
														+'<b class="w3-small w3-text-grey">'+result[x].body+'</b>'
													+'</div>'
													+'<div class="w3-margin-left w3-margin-top w3-text-grey w3-right w3-quarter">'
														+'<button class="w3-padding w3-teal w3-btn w3-small">Expand</button>'
													+'</div>'
												+'</div>'
												+'<div class="subquestions w3-white w3-text-grey w3-small"></div>'
											+'</div>';
									txt += '<div id="question'+result[x].id+'" class="w3-border-light-gray w3-border w3-margin-top w3-hide-large" style="padding:5px;">'
											+'<div class="w3-light-gray w3-row w3-padding">'
												
												+'<div class="w3-margin-left bluefont w3-left">'
													+'<h4 class="w3-small">'
														+'<b class="w3-text-grey">'+result[x].number+'.</b>'
														+result[x].topicname+'</h4>'
													+'<b class="w3-small w3-text-grey">'+result[x].body+'</b>'
												+'</div>'
												+'<div class="w3-margin-left w3-margin-top w3-text-grey w3-right w3-quarter">'
													+'<button class="w3-padding w3-teal w3-btn w3-small">Expand</button>'
												+'</div>'
											+'</div>'
											+'<div class="subquestions w3-white w3-text-grey w3-small"></div>'
										+'</div>';
								}
								
								
								ctr += 1;
                            }
                            //alert(txt);
                            if(ctr===0){
                                $("#epQuestionList").html("There are no candidates avalaible in this class");
                            }else{
                                $("#epQuestionList").html(txt);
                            }
                            
                            break;
                        case "fillmarks"://case for displaying exam paper scores
						
                            var txt = "";
                            var ctr = 0;
                            for (x in result){
								//alert("ni hao");
                                //txt += "<option value='"+result[x].ID+"'>"+result[x].name+"</option>";
                                txt += '<div class="w3-hide-small w3-light-gray w3-round w3-border w3-row w3-margin-top">'
                                            +'<div class="w3-round-xxlarge w3-left w3-border w3-white" style="padding: 5px;margin: 5px;">'
                                                +'<div class="w3-round-xxlarge bgpiccover" style="background-image: url(Views/default/images/user.png);height: 50px; min-width:50px;padding: 5px;margin:5px"></div>'
                                            +'</div>'
                                            +'<div class="w3-margin-left bluefont w3-left">'
                                                +'<h4 class="w3-small">'+result[x].fullname+' </h4>'
                                                +'<b class="w3-small">'+result[x].classname+'</b>'
                                            +'</div>'
                                            +'<div class="w3-margin w3-text-grey w3-right w3-quarter">'
												+'<input class="w3-input scorefields" placeholder="0.0" value="'+result[x].score+'" stdid="'+result[x].studentid+'" paperid="'+examid+'" scoreid="'+result[x].scoreid+'" />'
                                            +'</div>'
                                        +'</div>';
								txt += '<div class=" w3-hide-large w3-light-gray w3-round w3-border w3-row w3-margin-top" style="padding-right:5px;">'
                                            +'<div class="w3-round-xxlarge w3-left w3-border w3-white" style="padding: 5px;margin: 5px;">'
                                                +'<div class="w3-round-xxlarge bgpiccover" style="background-image: url(Views/default/images/user.png);height: 30px; min-width:30px;padding: 5px;margin:5px"></div>'
                                            +'</div>'
                                            +'<div class="w3-margin-left bluefont w3-left">'
                                                +'<h4 class="w3-small">'+result[x].fullname+' </h4>'
                                                +'<b class="w3-small">'+result[x].classname+'</b>'
                                            +'</div>'
                                            +'<div class=" w3-right">'
												+'<input class="w3-margin-top w3-text-grey" style="width:30px;margin-right5px;" placeholder="0.0" value="'+result[x].score+'" stdid="'+result[x].studentid+'" paperid="'+examid+'" scoreid="'+result[x].scoreid+'" />'
                                            +'</div>'
                                        +'</div>';
										//alert(examid);
                                
                                
                                ctr += 1;
                            }
                            //alert(txt);
                            if(ctr===0){
                                $("#stdlist").html("There are no candidates avalaible in this class");
                            }else{
                                $("#stdlist").html(txt);
                            }
                            
                            break;
                        
                    }
                });
        },
		
        subjectPaperContributionModal: function () {
            ///alert(action+examid);
			document.getElementById('subjectPaperContributionModal').style.display = 'block';
			
            var query="";
			var bits = $('#bits').attr('class');

            switch(action)
            {
				case "viewEP"://Create query for exam score filling

					var epname = $(event.target).attr("papername");
					var epclname = $(event.target).attr("paperclass");
					$("#modalPaperName").html(epname);
					$("#modalPaperClass").html(epclname);
					
					query = bits+"lib/exams/exams.php?action=fetchEPObject&classid="+classid;
					this.object = {
						paperid:examid
					};
					break;
					
				case "viewQuestion"://Create query for exam score filling

					var questionid = $(event.target).attr("questionid");
					var epclname = $(event.target).attr("paperclass");
					$("#modalPaperName").html(epname);
					$("#modalPaperClass").html(epclname);
					
					query = bits+"lib/exams/exams.php?action=fetchEPObject&classid="+classid;
					this.object = {
						paperid:examid
					};
					break;
					
				case "fillmarks"://Create query for exam score filling
				
					var epname = $(event.target).attr("papername");
					var epclname = $(event.target).attr("paperclass");
					$("#modalPaperName").html(epname);
					//alert(epclname);
					$("#modalPaperClass").html(epclname);
					
                    query = bits+"lib/exams/exams.php?action=getcandidates&classid="+classid;
					
                    this.object = {
                        //value:$("select[name='"+name+"']").val(),
                        paperid:examid
                    };
                    break;
                    
                case "submitmarks":
                    var inputs = $("#stdlist").children('input');
                    query = bits+"lib/exams/exams.php?action=submitmarks&classid="+classid;
					
					var scores;
					var scoresArray = [];
					
                    var ctr = 0;
                    $("#stdlist :input").each(function()
						{
                            if($(this).is(":visible")){
                                ctr++;
                                //alert(ctr);
                                var scoreid = $(this).attr("scoreid");
                                var stdid = $(this).attr("stdid");
                                var paperid = $(this).attr("paperid");
                                var score = $(this).val();
                                
                                if(score>=0){
                                    scoresArray.push({id:scoreid,studentid:stdid,paper:paperid,scorevalue:score});
                                }	
                            }						
						}
					);
					
					this.object = {scores:scoresArray};
                    
                    break;
                
            }
         
            $.post(query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    var result = JSON.parse(data);
                    switch(action)
                    {
						case "viewEP":
							//alert(result);
                            var txt = "";
                            var ctr = 0;
                            for (x in result){
								if(result[x].level === 1)
								{
									txt += '<div id="question'+result[x].id+'" class="w3-border-light-gray w3-border w3-margin-top w3-hide-small" style="padding:5px;">'
												+'<div class="w3-light-gray w3-row w3-padding">'
													+'<div class="w3-left w3-text-grey" style="height: 50px; font-weight:bold; min-width:50px;padding: 5px;margin:5px">'
														+'<b><h1>'+result[x].number+'.</h1></b>'
													+'</div>'
													+'<div class="w3-margin-left bluefont w3-left">'
														+'<h4 class="w3-small">'+result[x].topicname+'</h4>'
														+'<b class="w3-small w3-text-grey">'+result[x].body+'</b>'
													+'</div>'
													+'<div class="w3-margin-left w3-margin-top w3-text-grey w3-right w3-quarter">'
														+'<button class="w3-padding w3-teal w3-btn w3-small">Expand</button>'
													+'</div>'
												+'</div>'
												+'<div class="subquestions w3-white w3-text-grey w3-small"></div>'
											+'</div>';
									txt += '<div id="question'+result[x].id+'" class="w3-border-light-gray w3-border w3-margin-top w3-hide-large" style="padding:5px;">'
											+'<div class="w3-light-gray w3-row w3-padding">'
												
												+'<div class="w3-margin-left bluefont w3-left">'
													+'<h4 class="w3-small">'
														+'<b class="w3-text-grey">'+result[x].number+'.</b>'
														+result[x].topicname+'</h4>'
													+'<b class="w3-small w3-text-grey">'+result[x].body+'</b>'
												+'</div>'
												+'<div class="w3-margin-left w3-margin-top w3-text-grey w3-right w3-quarter">'
													+'<button class="w3-padding w3-teal w3-btn w3-small">Expand</button>'
												+'</div>'
											+'</div>'
											+'<div class="subquestions w3-white w3-text-grey w3-small"></div>'
										+'</div>';
								}
								
								
								ctr += 1;
                            }
                            //alert(txt);
                            if(ctr===0){
                                $("#epQuestionList").html("There are no candidates avalaible in this class");
                            }else{
                                $("#epQuestionList").html(txt);
                            }
                            
                            break;
                        case "fillmarks"://case for displaying exam paper scores
						
                            var txt = "";
                            var ctr = 0;
                            for (x in result){
								//alert("ni hao");
                                //txt += "<option value='"+result[x].ID+"'>"+result[x].name+"</option>";
                                txt += '<div class="w3-hide-small w3-light-gray w3-round w3-border w3-row w3-margin-top">'
                                            +'<div class="w3-round-xxlarge w3-left w3-border w3-white" style="padding: 5px;margin: 5px;">'
                                                +'<div class="w3-round-xxlarge bgpiccover" style="background-image: url(Views/default/images/user.png);height: 50px; min-width:50px;padding: 5px;margin:5px"></div>'
                                            +'</div>'
                                            +'<div class="w3-margin-left bluefont w3-left">'
                                                +'<h4 class="w3-small">'+result[x].fullname+' </h4>'
                                                +'<b class="w3-small">'+result[x].classname+'</b>'
                                            +'</div>'
                                            +'<div class="w3-margin w3-text-grey w3-right w3-quarter">'
												+'<input class="w3-input scorefields" placeholder="0.0" value="'+result[x].score+'" stdid="'+result[x].studentid+'" paperid="'+examid+'" scoreid="'+result[x].scoreid+'" />'
                                            +'</div>'
                                        +'</div>';
								txt += '<div class=" w3-hide-large w3-light-gray w3-round w3-border w3-row w3-margin-top" style="padding-right:5px;">'
                                            +'<div class="w3-round-xxlarge w3-left w3-border w3-white" style="padding: 5px;margin: 5px;">'
                                                +'<div class="w3-round-xxlarge bgpiccover" style="background-image: url(Views/default/images/user.png);height: 30px; min-width:30px;padding: 5px;margin:5px"></div>'
                                            +'</div>'
                                            +'<div class="w3-margin-left bluefont w3-left">'
                                                +'<h4 class="w3-small">'+result[x].fullname+' </h4>'
                                                +'<b class="w3-small">'+result[x].classname+'</b>'
                                            +'</div>'
                                            +'<div class=" w3-right">'
												+'<input class="w3-margin-top w3-text-grey" style="width:30px;margin-right5px;" placeholder="0.0" value="'+result[x].score+'" stdid="'+result[x].studentid+'" paperid="'+examid+'" scoreid="'+result[x].scoreid+'" />'
                                            +'</div>'
                                        +'</div>';
										//alert(examid);
                                
                                
                                ctr += 1;
                            }
                            //alert(txt);
                            if(ctr===0){
                                $("#stdlist").html("There are no candidates avalaible in this class");
                            }else{
                                $("#stdlist").html(txt);
                            }
                            
                            break;
                        
                    }
                });
        },
        loadSubContPapers: function (termid,classid,subjectid,typeid) {

            
            
			var bits = $('#bits').attr('class');
            var query="";
            query = bits+"lib/exams/exams.php?action=getspcpapers";

            var termid = $("#spcTermSelect option:selected").val();
            
            this.object = {
                termid:termid,
                classid:classid,
                typeid:typeid,
                subjectid:subjectid
            };
            
            //alert(termid+classid+typeid+subjectid);

            $.post(query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    var result = JSON.parse(data);
                    //alert(result);
                    var txt = "";
                    var ctr = 0;
                    for (x in result)
                    {
                        txt += '<li class=""  style="width:100%">'
                                    +'<div onclick="exams.spcPaperBTN(\''+result[x].ID+'\')" class="w3-border redtheme w3-round w3-card w3-btn w3-padding" paperid="'+result[x].paperid+'" style="width:100%">'
                                        +'<h4 class="w3-tiny">'+result[x].name+'</h4>'
                                    +'</div>'
                                +'</li>';
                        
                        ctr += 1;
                    }
                    
                    //alert(txt);
                    if(ctr===0){
                        $("#spcPaperList").html("There are no papers currently avalaible");
                    }else{
                        $("#spcPaperList").html(txt);
                    }
                });
        
        },
        spcPaperBTN: function (paperid) {

            $('#spcRightSide input, button').attr('style', "style='display:none'");            
            
			var bits = $('#bits').attr('class');
            var query="";
            query = bits+"lib/exams/exams.php?action=getspcpapercontribution";
            
            var termid = $("#spcTermSelect option:selected").val();
            this.object = {
                termid:termid,
                paperid:paperid
            };

            $("#spcContribution").attr('paperid',paperid);
            $("#spcContribution").attr('termid',termid);

            $.post(query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    var result = JSON.parse(data);

                    var txt = "";
                    var ctr = 0;
                    for (x in result)
                    {
                        alert(rexult[x].contribution);
                        $("#spcContribution").val(rexult[x].contribution);
                    }
                });
        
        },
        saveSPContribution: function () {
            
			var bits = $('#bits').attr('class');
            var query="";
            query = bits+"lib/exams/exams.php?action=savespc";

            var paperid = $("#spcContribution").attr('paperid');
            var termid = $("#spcContribution").attr('termid');
            var cont = $("#spcContribution").val();

            var typeid = $("#spaExamTypeSelect option:selected").val();
            
            this.object = {
                termid:termid,
                paperid:paperid,
                contribution:cont,
                type:typeid
            };

            

            $.post(query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    var result = JSON.parse(data);

                    var txt = "";
                    var ctr = 0;
                    for (x in result)
                    {
                        alert(rexult[x].contribution);
                        $("#spcContribution").val(rexult[x].contribution);
                    }
                });
        
        }
    };
    
    var reports = {
        object: "John",
		showListModal: function(modalfor)
		{
			switch(modalfor)
            {
				case "studentReports":
					document.getElementById('selectStudentReportTypeModal').style.display='block';
					break;
			}
		},
        tabClicked: function (tabid) {
            alert(tabid);
			
			
            var query="";
			var bits = $('#bits').attr('class');

            switch(tabid)
            {
				case "academic"://Create query for exam score filling
                    //alert(tabid);
					$("#tabContainer #title").html("Academic Reports");
					break;
                
            }
         
            
        },

        loadStudents:function(termid,classid)
        {
            //alert(termid+""+classid);
            var classtext = $("#selectEOTRepClass option:selected").text();
            classtext = "<b class='redfont'>"+classtext+"</b>";
            var termtext = $("#selectEOTRepTerm option:selected").text();
            termtext = "<span class='bluefont'>"+termtext+"</span>";
            $('#title').html("Students in "+classtext+", "+termtext);

            var bits = $('#bits').attr('class');
            this.query = bits+"lib/classes/stdclass.php?action=liststudents&filter=1";
            this.object = {
                        classid:classid
                        ,termid:termid
                    };

            $.post(this.query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    result = JSON.parse(data); 
                    //alert(result);
                    var txt = ""; var x=0; var ctr = 0;
                    for (x in result){
                        //alert(result[x].stdname);
                                //txt += "<option value='"+result[x].ID+"'>"+result[x].name+"</option>";
                                txt += ''
                                    +'<li>'
                                    + '<div class="w3-row">'
                                        +'<input id="'+result[x].studentid+'" type="checkbox" class="studentCB w3-large w3-left" />' 
                                        +'<div class="w3-left" style="margin-left:10px;">'+result[x].stdname+'</div>'
                                    +'</div></li>';
                                ctr += 1;

                            }
                    $('#repStudentList').html(txt);
                }
            );
            
        },

        settingsModal:function()
        {
            //alert("");
            document.getElementById('reportSettingsModal').style.display='block';
        },

        saveTermSettings:function()
        {
            var bits = $('#bits').attr('class');
            this.query = bits+"lib/reports/reports.php?action=savetermsettings&filter=1";

            
            var termid = $("#selectEOTRepTerm option:selected").val();
            var numofassignments = $("#noofassignments").val();
            var numoftests = $("#nooftests").val();
            var assigcont = $("#assigpercentage").val();
            var testcont = $("#testpercentage").val();
            var fecont = $("#fepercentage").val();
            var nexttermbegins = $("#next_term_date").val();

            this.object = {
                        termid:termid
                        ,numofassignments:numofassignments
                        ,numoftests:numoftests
                        ,assigcont:assigcont
                        ,testcont:testcont
                        ,fecont:fecont
                        ,nexttermbegins:nexttermbegins
                    };

            //alert(this.query);

            $.post(this.query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    //var w = window.open(data);
                    location.reload();
                    //$(w.document.body).html(data);
                    
                    //alert("My Data: " + data + "\nStatus: " + status);
                   
                }
            );
        },
		
        
        generateNow:function(name)
        {
            alert(name);
            var bits = $('#bits').attr('class');
            switch(name)
            {
                case "eot":
                    this.query = bits+"lib/reports/reports.php?action=generateNow&filter=1&name="+name;
                    var studentsarray = [];
                    $("input.studentCB").each(function()
                        {
                            if($(this).is(":checked")){                        
                                studentsarray.push($(this).attr('id'));
                            }
                        }
                    );
					
					if($('#stdid').attr('class')>0)
					{
						//alert('Ian');
						studentsarray.push($('#stdid').attr('class'));
					}

                    var classid = $("#selectEOTRepClass option:selected").val();
                    var termid = $("#selectEOTRepTerm option:selected").val();

                    this.object = {
                        classid:classid
                        ,termid:termid
                        ,students:studentsarray
                    };

                    break;
                case "classfile":
                    this.query = bits+"lib/reports/reports.php?action=generateNow&filter=1&name="+name;
                    var studentsarray = [];
                    $("#studentlist li").each(function()
                        {
                            var li = $(this);
                            var stdname = $(this).find('.stdname').html();

                            var subjects = $(this).find('.subjects').html();
                            subjects = subjects.replace("<b>","");
                            subjects = subjects.replace("</b>","");

                            var atthist = $(this).find('.atthist').html();
                            atthist = atthist.replace("<b>","");
                            atthist = atthist.replace("</b>","");
                            
                            //alert(stdname);
                            var stdrow = [];
                            stdrow.push($(this).attr('id'));
                            stdrow.push(stdname);
                            stdrow.push(subjects);
                            stdrow.push(atthist);
                            studentsarray.push(stdrow);
                        }
                    );

                    var classid = $("#classid").attr("class");
                    var classname = $("#classname").html();
                    var classabbr = $("#classabbr").html();
                    //var termid = $("#termid").attr("class");
                    var termid = 1;

                    this.object = {
                        classid:classid
                        ,classname:classname
                        ,classabbr:classabbr
                        ,termid:termid
                        ,students:studentsarray
                    };
                    break;
                case "classtestsummary":
                    this.query = bits+"lib/reports/reports.php?action=generateNow&filter=1&name="+name;
                    var studentsarray = [];
                    var gradesarray = [];
                    var subjectsarray = [];
                    
                    $("#testsummarytable .headings td").each(function(){
                        subjectsarray.push($(this).text());
                    });
                    alert(subjectsarray);
                    $("#testsummarytable .stdrow").each(function(){
                        var stdrow = [];
                        $(this).find(".stdname, .score, .avg").each(function(){
                            stdrow.push($(this).text());
                        });
                        studentsarray.push(stdrow);
                        
                        stdrow = [];
                        $(this).find(".stdname, .grade, .avg").each(function(){
                            stdrow.push($(this).text());
                        });
                        gradesarray.push(stdrow);
                    });

                    var reptype = $("select[name='reptype']").val();
                    //alert("Report Type"+reptype);
                    this.object = {
                        showing:reptype,
                        classabbr:$("#classabbr").text(),
                        subjectsarray:subjectsarray,
                        gradesarray:gradesarray,
                        studentsarray:studentsarray
                    };
                    
                    break;
                case "studentattendance":
                    this.query = bits+"lib/reports/reports.php?action=generateNow&filter=1&name="+name;
                    var stdid = $("#stdid").attr("class");
                    var fromdate = $("#daDateFrom").val();
                    var todate = $("#daDateTo").val();
                    alert("from date "+fromdate);
                    this.object = {
                        studentid:stdid,
						fromdate:fromdate,
						todate:todate
                    };
                    break;
            }

            $.post(this.query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    var w = window.open(data);
                    
                    $(w.document.body).html(data);
                    w.reload();
                    
                    
                    //alert("My Data: " + data + "\nStatus: " + status);
                   
                }
            );
            
        }
    };
    
    var library = {
        object:"me",
        query:"",
        bookCreationModal:function()
		{
		    
		    document.getElementById('bookCreationModal').style.display='block';
		    var btn = event.target;
		    $('#modalCIOBookTitle').html(title);
		    $('#modalCIOHeading').html($(btn).text());
		    //$('#bookCheckinoutModal').attr('action',$(btn).text());
		},
        bookCheckinoutModal:function(id,title)
		{
		    
		    document.getElementById('bookCheckinoutModal').style.display='block';
		    var btn = event.target;
		    $('#modalCIOBookTitle').html(title);
		    $('#modalCIOHeading').html($(btn).text());
		    $('#bookCheckinoutModal').attr('action',$(btn).text());
		},
        selectCustodianBTN:function(id,title)
		{
		    document.getElementById('custodianSearchResults').style.display='none';
		    $('#selectedCustodian').html(title);
		    /*var btn = event.target;
		    $('#modalCIOBookTitle').html(title);
		    $('#modalCIOHeading').html($(btn).text());
		    $('#bookCheckinoutModal').attr('action',$(btn).text());*/
		},
		submitBookCheckinout:function()
		{
		    var action = $('#bookCheckinoutModal').attr('action');
		    if(action=="Check out")
		    {
		        
		    }
		}
    };
    
    var academics = {
        object:"me",
        query:"",
        showExamCategoryModal:function()
		{
		    //alert(stdid);
		    document.getElementById('examTypeLinksModal').style.display='block';
		    //$("#stdTransferModal").attr('stdid',stdid);
		    var bits = $('#bits').attr('class');
            this.query = bits+"lib/exams/exams.php?action=getcategories&filter=1&stdid="+stdid+"&fromclass="+fromclass+"&toclass="+toclass+"&termid="+termid;
            //this.object = {};

            //alert(this.query);

            $.post(this.query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    //var w = window.open(data);
                    location.reload();
                    //$(w.document.body).html(data);
                    
                    //alert("My Data: " + data + "\nStatus: " + status);
                   
                }
            );
		},
        saveNewExamPaper:function()
		{
		    //document.getElementById('examTypeLinksModal').style.display='block';
		    //$("#stdTransferModal").attr('stdid',stdid);
		    var bits = $('#bits').attr('class');
            this.query = bits+"lib/exams/exams.php?action=createnew&filter=1";
            var title = $("input[name='nepExamName']").val();
            var outof = $("input[name='nepOutof']").val();
            //var subject = $("select[name='nepSubject']").val();
            var subject = $("select[name='nepSubject']").val();
            var examtype = $("select[name='nepType']").val();
            
            //nepClasses[]
            var classctr = 0;
            var classes = [];
            var sList = -1;
            $('input[type=checkbox]').each(function () {
                //sList += "(" + $(this).val() + "-" + (this.checked ? 1 : "not checked") + ")";
                if(this.checked)
                {
                    classes.push($(this).val());
                    classctr++;
                }
                
            });
            
            if(title==''||title.length<1)
            {
                alert('Title cannot be empty');
                $("input[name='nepExamName']").focus();
                $("input[name='nepExamName']").addClass('w3-border');
                $("input[name='nepExamName']").addClass('w3-border-orange');
                exit();
            }
            else
            {
                $("input[name='nepExamName']").removeClass('w3-border-orange');
            }
            
            if(outof==''||outof.length<1)
            {
                alert('Outof cannot be empty');
                $("input[name='nepOutof']").focus();
                $("input[name='nepOutof']").addClass('w3-border');
                $("input[name='nepOutof']").addClass('w3-border-orange');
                exit();
            }
            else
            {
                $("input[name='nepOutof']").removeClass('w3-border-orange');
            }
            
            if(subject=='All Subjects')
            {
                alert('Please select a subject');
                $("select[name='nepSubject']").focus();
                $("select[name='nepSubject']").addClass('w3-border-orange');
                exit();
            }
            else
            {
                $("select[name='nepSubject']").removeClass('w3-border-orange');
            }
            
            if(classctr<1)
            {
                alert('Please select atleast one class');
                //$("input[name='nepOutof']").focus();
                $("#nepClassesDIV").addClass('w3-border');
                $("#nepClassesDIV").addClass('w3-border-orange');
                exit();
            }
            else
            {
                $("#nepClassesDIV").removeClass('w3-border');
                $("#nepClassesDIV").removeClass('w3-border-orange');
            }
            
            //alert('Before object'+examtype);
            this.object = {
                examname:title
                ,outof:outof
                ,subject:subject
                ,eptype:examtype
                ,classes:classes
            };
           
            $.post(this.query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    //var w = window.open(data);
                    location.reload();
                    //$(w.document.body).html(data);
                    
                    //alert("My Data: " + data + "\nStatus: " + status);
                   
                }
            );
		}
        
    };
   
    var attendance = {
        query: "",
        object: "John",
		
        showClassAttencanceModal: function (classid,atttype) {  
            //alert(classid+atttype);
            document.getElementById('takeRegModal').style.display='block';    
            if(atttype=="Daily"){
                $("#takeRegModalTitle b").html("Select Class");
                //alert();
                this.loadClassStudentList(0,classid,atttype);
            }else{
                this.loadClassStudentList(0,classid,atttype);
            }
        },
		
        showTeacherLessonAbsentSubModal: function (teacherid, classid,date) {  
            
            document.getElementById('teacherLessonAbsentFormModal').style.display='block';    
            
            this.object = {
                        classid:classid
                        ,teacherid:teacherid
                        ,date:date
                    };

            //alert(date);

            var bits = $('#bits').attr('class');
            this.query = bits+"lib/teachers/teacher.php?action=teacherperiods&filter=1";

            $.post(this.query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    result = JSON.parse(data); 
                    //alert(result);
                    var txt = ""; var x=0; var ctr = 0;
                    for (x in result){
                        txt += '<lesson teacherid="'+result[x].classabbr+'" date="'+date+'" lessonid="'+result[x].ID+'" classid="'+classid+'">'
                                        +'<input type="checkbox" id="period" name="period"  value="'+result[x].ID+'">'
                                        +'<label for="period" class="w3-tiny"> '
                                        +'<b class="bluefont">'+result[x].classabbr+'</b>'
                                        +', <span class="">'+result[x].subjectabbr+'</span>'
                                        +', <span class="redfont">'+result[x].fstart+'-'+result[x].fend+'</span>'
                                        +'</label><br>'
                                +'</lesson>';
                        
                        //ctr += 1;
                        alert(txt);
                    }

                    $('#teacherlessonstoday').html(txt);
                }
            );
        },
		
        statusBTN: function (btn) {  
            var txt = $(btn).text();

            $(btn).removeClass("present");
            $(btn).removeClass("absent");
            $(btn).removeClass("late");
            $(btn).removeClass("sick");
            $(btn).removeClass("holiday");
            $(btn).removeClass("dropout");

            switch(txt)
            {
                case "P":
                    $(btn).text("A");
                    $(btn).addClass("absent");
                    $(btn).parent().find('div.time').html("");
                    break;
                case "A":
                    $(btn).text("L");
                    $(btn).addClass("late");
                    var timein = $(btn).attr("timein");
                    $(btn).parent().find('div.time').html("<div class='w3-left w3-margin-left'>Time In<br><input type='time' class='w3-left' value="+timein+" /></div>");
                    break;
                case "L":
                    $(btn).text("S");
                    $(btn).addClass("sick");
                    $(btn).parent().find('div.time').html("");
                    break;
                case "S":
                    $(btn).text("H");
                    $(btn).addClass("holiday");
                    $(btn).parent().find('div.time').html("");
                    break;
                case "H":
                    $(btn).text("D");
                    $(btn).addClass("dropout");
                    $(btn).parent().find('div.time').html("");
                    break;
                case "D":
                    $(btn).text("P");
                    $(btn).addClass("present");
                    $(btn).parent().find('div.time').html("");
                    break;
            }
        },

        loadClassStudentList:function(termid,classid,atttype)
        {
            //alert(termid+""+classid);
            var bits = $('#bits').attr('class');
            if(atttype==='Daily'){
                this.query = bits+"lib/classes/stdclass.php?action=studentAttList&filter=1";
                this.query = '/getmsg?isajax=true';
            }
            if(atttype==='Period'){
                this.query = bits+"lib/periods/lessonperiods.php?action=studentAttList&filter=1";
            }
            this.object = {
                        classid:classid
                        ,for:'class'
                        ,date:''
                    };

            $.get(this.query,
                this.object,
                function (data, status) {
                    alert("My Data: dhd" + data + "\nStatus: " + status);
                    /*
                    result = JSON.parse(data); 
                    //alert(result);
                    var txt = ""; var x=0; var ctr = 0;
                    for (x in result){
                        var latetime = "";
                        //alert(result[x].attstatus);
                        if(result[x].attstatus=="L")
                        {
                            latetime = "<div class='w3-left w3-margin-left'>Time In<br><input type='time' class='w3-left' value="+result[x].timein+" /></div>";
                            alert(latetime);
                        }
                        txt += ''
                            +'<li class="w3-row">'
                                +'<div class="w3-left w3-small">'
                                +result[x].stdname
                                +'<br><b>History : </b> <span class="w3-tiny">'+result[x].atthist+'</span>'
                                +'</div>'
                                +'<div class="time w3-right">'+latetime+'</div>'
                                +'<button id="'+result[x].studentid+'" timein="'+result[x].timein+'" class="attstatusbtn w3-btn w3-right w3-margin-left  w3-card w3-round w3-small '+result[x].btnbg+'" onclick="attendance.statusBTN(this)">'
                                    +result[x].attstatus
                                +'</button>'
                            +'</li>';
                        
                        ctr += 1;
                    }

                    $('#classAttendanceStdList').html(txt);
                    */
                }
            );
            
        },

        saveNow:function(classid)
        {
            var bits = $('#bits').attr('class');
            this.query = bits+"lib/classes/stdclass.php?action=saveAttendance&filter=1";

            var d = new Date();
            var date = $('#attendanceDate').val();

            var studentsarray = [];
            $("button.attstatusbtn").each(function()
                {
                    var array = [];
                    array.push($(this).attr('id'));
                    array.push($(this).text());
                    
                    var time = $(this).parent().find('div.time').find('input').val();
                    array.push(time);
                    //alert(time);
                    if(time==undefined)
                    {
                        time="0:00";
                    }

                    var object = {"studentid":$(this).attr('id'),"classid":classid,"periodid":classid,"attstatus":$(this).text(),"time":time,"date":date};
                    studentsarray.push(object);
                }
            );

            var termid = $("#selectEOTRepTerm option:selected").val();
            

            this.object = {
                        classid:classid
                        ,termid:termid
                        ,students:JSON.stringify(studentsarray)
                    };

            //alert(this.query);

            $.post(this.query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    alert("Today's Attendance Register was successfully submitted");
                    
                    
                    
                   
                }
            );
            
        }
    };
	
    var student = {
        object: "John",
        reportTab: function (action) {
			
			$('#generateNowBTN').attr('onclick','reports.generateNow(\''+action+'\')');
			alert(action);
            
            var query="";
            switch(action)
            {
				case "studentattendance":
					
					break;
			}
		}
	};
    
    var assignment = {
        object: "John",
        query: "",
        selectCBX: function()
		{
			var ctr = 0;
			var students = [];
			$('.paperlistcbx:checked').each(
				function(){
					ctr++;
					students.push($(this).attr('paperid'));
					document.getElementById('actionbtns').style.display = 'block';
				}
			);
			if(ctr<=0)
			{
				document.getElementById('actionbtns').style.display = 'none';
			}			
		},
        processAssigPaper: function (action,assigid,classid,papername) {
            //alert(action);

            switch(action)
            {
                case "fillmarks":
                    //alert("Paper id is "+action);
                    $("#classid").attr("classid",classid);
                    $("#classid").attr("paperid",assigid);
                    
                    $("#modalPaperName").html(papername);
                    //alert(assigid);
                    $("#modalPaperClass").html($("#classname"+assigid));
                    
                    var bits = $('#bits').attr('class');
                    this.query = bits+"lib/assignments/assignments.php?action=getcandidates&classid="+classid;
                    //alert(this.query);
                    
                    this.object = {
                        paperid:assigid
                    };
                    break;
                    
                case "submitmarks":
                    //alert('hi');
                    //var inputs = $("#stdlist").children('input');
                    var inputs = $(".scorefields");
                    var bits = $('#bits').attr('class');
                    classid = $("#classid").attr("classid");
                    this.query = bits+"lib/assignments/assignments.php?action=submitmarks&classid="+classid;

                    var scoresarray = ['0'];
                    var ctr = 0;
                    //alert(inputs.elements[0].value);
                    
                    var i;
                    //alert(sizeof(inputs));
                    //for(ctr = 0; ctr<inputs.length; ctr++)
                    $(".scorefields").each(function()
                        {
                            
                            var scoreid = $(this).attr("scoreid");
                            var stdid = $(this).attr("stdid");
                            var paperid = $(this).attr("paperid");
                            var value = $(this).val();

                            //Order is scoreid,stdid,paperid,value

                            //alert(scoreid);
                            
                            var scorearray = [];
                            scorearray.push(scoreid);
                            scorearray.push(stdid);
                            scorearray.push(paperid);
                            scorearray.push(value);
                            
                            //alert(scorearray);
                            scoresarray[ctr] = scorearray;
                            ctr++;
                        }
                    );
                    
                    this.object = {scoresarray:scoresarray};
                    
                    break;
                    
                case "publish":

                    var inputs = $(".scorefields");
                    var bits = $('#bits').attr('class');
                    //classid%2
                    break;
            }
        }
    };
    
    var stdclass = {
        object: "",
        query: "",
        loadSubjectStdTakingStats: function(classid,subjectid)
		{
            //alert('Please select a class');
		    var bits = $('#bits').attr('class');
		    this.query = bits+"lib/classes/stdclass.php?action=getstudentsubjectstats&classid="+classid+"&subjectid="+subjectid;
			this.query = "/getmsg";
            this.object = {
				//paperid:examid
			};
			
			//alert(this.query);
			
			$.get(this.query,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    r = data; 
                    //r = JSON.parse(data); 
                    //alert(r);
                    for(x in r)
                    {
                        
                        var mctr = r[x].malectr;
                        var fctr = r[x].femalectr;
                        var stdctr = r[x].stdctr;
                        $('#stdsubstats h1').html(stdctr);
                        
                        var genders = ["Male", "Female"];
                        var gendersuballoc = [];
                        gendersuballoc.push(mctr);
                        gendersuballoc.push(fctr);
                       
                        var barColors = [
                          "#b91d47",
                          "#00aba9",
                          
                        ];
                        
                        $("#subjectStdCanvas").html("");
                        
                        new Chart("subjectStdCanvas", {
                          type: "doughnut",
                          data: {
                            labels: genders,
                            datasets: [{
                              backgroundColor: barColors,
                              data: gendersuballoc
                            }]
                          },
                          options: {
                            title: {
                              display: true,
                              text: "Distribution According To Gender"
                            }
                          }
                        });
                        
                        //const obj = document.getElementById("value");
                        
                    }
                    var txt = ""; var x=0; var ctr = 0;
                    
                    $("#stdSubjectMatrixModalCont").html(txt);
                    const obj = $('#stdsubstats h1');
                    general.animateValue(obj, 100, 0, 5000);
                });
		},
		saveSubjectStudentsAlloc:function()//Save One subject student allocation
		{
		    var subjectid = $("#stdtakingsubSelect option:selected").val();
		    var classid = $("#classid").attr("class");
		    var students = [];
		    $('#subjectstdstable .takingcb').each(function( ) {
                var student = [];
               
                if($(this).is(':checked')){
                    student.push($(this).attr("stdid"));
                    student.push(subjectid);
                    students.push(student);
                }
               
            });
            var bits = $('#bits').attr('class');
		    this.query = bits+"lib/classes/stdclass.php?action=savestudentsubjects&subjectid="+subjectid+"&classid="+classid;
			this.object = {
				students:students
			};
			$.post(this.query,
                this.object,
                function (data, status) {
                    alert(" My Data: " + data + "\nStatus: " + status);
                    
                });
		},
        stdSubjectMatrix: function()
		{
		    document.getElementById('stdSubjectMatrixModal').style.display = 'block';
		    var classid = $("#classid").attr("class");
		    var bits = $('#bits').attr('class');
		    //this.query = bits+"lib/classes/stdclass.php?action=getstudentsubjects&classid="+classid+"&termid=1";
		    this.query = "/classes/ajax?action=getstudentsubjects&classid="+classid+"&termid=1";
			
			
			//alert(this.query);
			
			$.get(this.query,
                function (data, status) {
                    alert(" My Data: " + data + "\nStatus: " + status);
                    r = JSON.parse(data); 
                    //alert(r);
                    var txt = ""; var x=0; var ctr = 0;
                    
                    txt += "<table>"
                        +"<tr>"+$("#classsubabbrs").text()
                        + "<td><input type='checkbox' onchange='general.checkboxChanged()' class='allsmrowscb' ></td>"
                        +"</tr>";
                    //$("#stdSubjectMatrixModalCont").html(txt);
                    for (x in r){
                        
                        txt += "<tr class='smstdrow' stdid='"+r[x].studentid+"'>";
                        txt += "<td>"+r[x].studentid+r[x].stdname+"</td>";
                        
                        var i;
                        var statuses = r[x].takingstatuses.split(",");
                        var subjects = r[x].thesubjects.split(",");

                        for(i=0;i<statuses.length;i++)
                        {
                            var init = "";
                            if(statuses[i]=="T"){
                                init = "checked";
                            }
                            var cb = "<input type='checkbox' "+init+" class='stdsubcb"+r[x].studentid+"' value='"+subjects[i]+"'  />";
                            txt += "<td>"
                                +cb
                                //+"stdsubcb"+r[x].studentid
                                +"</td>";
                        }
                        txt += "<td><input type='checkbox' class='entiresmrowcb' stdid='"+r[x].studentid+"' onchange='general.checkboxChanged()' ></td>";
                        //txt += "stdsubcb"+r[x].studentid;
                        txt += "<tr>";
                    }
                    txt += "</table>";

                    $("#stdSubjectMatrixModalCont").html(txt);
                });
		},
		saveStdSubjectMatrix: function()
		{
		    var students = [];
		    var ids = [];
		    $('.smstdrow').each(function( ) {
		        var stdid = $(this).attr('stdid');
                var student = [];
                student.push(stdid);
                var subs = [];
                var entered = false;
                $(this).find(".stdsubcb"+stdid).each(function(){
                    if($(this).is(':checked')){
                        subs.push($(this).attr("value"));
                        entered = true;
                    }
                });
                student.push(subs);
                students.push(student);
               
            });
            
            var termid = $("#selectStdSubjectTerm option:selected").val();
            
            var bits = $('#bits').attr('class');
		    this.query = bits+"lib/classes/stdclass.php?action=savestudentsubjects&termid="+termid;
			this.object = {
				students:students
			};
			
			//alert(this.query);
			
			$.post(this.query,
                this.object,
                function (data, status) {
                    alert(" My Data: " + data + "\nStatus: " + status);
                    location.reload();
                });
		},
		loadSubjectStdsEditForm: function()
		{
		    document.getElementById('editSubjectStudentsModal').style.display='block';
		    var subname = $("#stdtakingsubSelect option:selected").attr('subname');
		    $('#editSubjectStudentsModal .title').html('Students Taking '+subname);
		    var students = [];
            
            var bits = $('#bits').attr('class');
            var termid = 1;
            var classid = $("#classid").attr('class');
            var subjectid = $("#stdtakingsubSelect option:selected").val();
            
            
		    this.query = bits+"lib/classes/stdclass.php?action=getsubjectstudents&subjectid="+subjectid+"&classid="+classid+"&termid="+termid;
			this.object = {
				students:students
			};
			
			//alert(this.query);
			
			$.post(this.query,
                this.object,
                function (data, status) {
                    //alert(" My Data: " + data + "\nStatus: " + status);
                    //location.reload();
                    var txt = "";
                    var r = JSON.parse(data);
                    for(x in r)
                    {
                        txt += "<tr>";
                        var stdname = "<td class='std'>"+r[x].stdname+"</td>";
                        if(r[x].takingstatus=="T"){
                            takingcb= "<input stdid='"+r[x].studentid+"' value='"+r[x].studentid+"' class='takingcb' type='checkbox' checked>";
                        }
                        else
                        {
                            takingcb= "<input type='checkbox' stdid='"+r[x].studentid+"' value='"+r[x].studentid+"'>";
                        }
                        takingcb = "<td>"+takingcb+"</td>";
                        txt += stdname+takingcb;
                        
                        txt += "</tr>";
                    }
                    
                    $("#subjectstdstable tbody").html(txt);
                    //alert(txt);
            });
		},
		summaryTab:function(tab,type,name)
		{
		    $(tab).siblings().removeClass("w3-white");
		    $(tab).siblings().addClass("w3-gray");
		    $(tab).removeClass("w3-gray");
		    $(tab).addClass("w3-white");
		    
		    $("#tabsubbuttons button").hide();
		    switch(name)
		    {
		        case "overall":
		            $("#tabsubbuttons button.overall").show();
		            summaries.showClassTestSummary();
		            break;
		        case "students":
		            $("#tabsubbuttons button.students").show();
		            break;
		    }
		},
		showStdTransferModal:function(btn,stdid,stdcode)
		{
		    //alert(stdid);
		    document.getElementById('stdTransferModal').style.display='block';
		    $("#stdTransferModal").attr('stdid',stdid);
		},
		submitTransfer:function()
		{
		    
		    var fromclass = $("#classid").attr('class');
		    var toclass = $("#selectDestClass option:selected").val();
		    var termid = $("#selectTransferTerm option:selected").val();
		    var bits = $('#bits').attr('class');
		    var stdid = $("#stdTransferModal").attr('stdid');
            this.query = bits+"lib/classes/stdclass.php?action=savestudenttransfer&filter=1&stdid="+stdid+"&fromclass="+fromclass+"&toclass="+toclass+"&termid="+termid;
            //this.object = {};

            //alert(this.query);

            $.post(this.query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    //var w = window.open(data);
                    location.reload();
                    //$(w.document.body).html(data);
                    
                    //alert("My Data: " + data + "\nStatus: " + status);
                   
                }
            );
		},
		showOtherClassesLinkModal:function(){
		    document.getElementById('otherClassLinksModal').style.display='block';
		},
		showClassHWModal:function(){
		    document.getElementById('classHWModal').style.display='block';
		    var bits = $('#bits').attr('class');
		    var classid = $("#classid").attr('class');
		    this.query = bits+"lib/classes/stdclass.php?action=getclasshomeworks&classid="+classid;
			this.object = {
				//paperid:examid
			};
			$.post(this.query,
                this.object,
                function (data, status) {
                    //alert(" My Data: " + data + "\nStatus: " + status);
                    
                    var txt = "";
                    var r = JSON.parse(data);
                    for(x in r)
                    {
                        txt += "<button class='w3-third w3-left w3-btn' onclick='stdclass.showPaper(\"homework\",\""+r[x].paperid+"\")'>"
                                    +"<div class='w3-margin w3-border w3-card w3-round w3-btn'>"
                                        +"<h1 class='w3-center redfont subabbr'>"+r[x].subabbr+"</h1>"
                                        +"<div class='w3-center w3-tiny papername'>"+r[x].name+"</div>"
                                        +"<div class='w3-center w3-tiny outof'>Out of "+r[x].outof+"</div>"
                                        +"<div class='w3-center w3-tiny redfont termname'>"+r[x].termname+"</div>"
                                    +"</div>"
                                +"</button>";
                                
                    }

                    $('#classhws').html(txt);
                });
		},
		submitStdsEditForm:function(){
		    var students = [];
		    $('#editStudentsForm').children('.stdrow').each(
                    function(){
                        var stdid = $(this).attr('stdid');
                        var fname = $(this).find('.fname').val();
                        var onames = $(this).find('.onames').val();
                        var sname = $(this).find('.sname').val();
                        
                        var dob = $(this).find('.dob').val();
                        var gender = $(this).find('.gender');
                        if(gender.attr('changed')=='true'){
                            gender = $(this).find('.gender').children("option:selected").val();
                        }else
                        {
                            gender = '';
                        }
                        
                        var std = [];
                        std.push(stdid);
                        std.push(fname);
                        std.push(onames);
                        std.push(sname);
                        std.push(dob);
                        std.push(gender);
                        
                        students.push(std);

                    });
                    
            var bits = $('#bits').attr('class');
		    var classid = $("#classid").attr('class');
		    this.query = bits+"lib/classes/stdclass.php?action=savestudentsedit&classid="+classid;
                    
            this.object = {
				students:students
			};
			$.post(this.query,
                this.object,
                function (data, status) {
                    alert(" My Data: " + data + "\nStatus: " + status);
                    //alert('Student Editing was successful, the page will now reload');
					location.reload(true);
                });
		},
		showPaper:function(papertype,paperid){
		    var btn = event.target;
		    var bits = $('#bits').attr('class');
		    var classid = $("#classid").attr('class');
		    this.query = bits+"lib/classes/stdclass.php?action=getclasshomeworks&classid="+classid;
		    
		    var txt = "<div class='w3-row w3-tiny w3-text-grey'>";
		    var papername = $(btn).children('.papername').text();
		    var sub = $(btn).children('.subabbr').text();
		    var outof = $(btn).children('.outof').text();
		    var term = $(btn).children('.termname').text();
            alert(sub+outof+term);
		    txt += "<h2 class='w3-row redfont'>"+papername+"</h2>"
		        +  "<div class='w3-row-padding w3-border w3-round'>"
		            //+"<div class='w3-left w3-margin-right w3-small'><b>Subject</b> : "+sub+"</div>"
		            +"<div class='w3-left  w3-margin-right w3-small'> "+outof+"</div>"
		            +"<div class='w3-left  w3-margin-right w3-small'> "+term+"</div>"
		        +  "</div>";
		    
			this.object = {
				//paperid:examid
			};
			$.post(this.query,
                this.object,
                function (data, status) {
                    //alert(" My Data: " + data + "\nStatus: " + status);
                    
                    var r = JSON.parse(data);
                    for(x in r)
                    {
                        txt += "<div class='w3-third w3-left' onclick='stdclass.showPaper(\'test\',\'"+r[x].paperid+"\')'>"
                                    +"<div class='w3-margin w3-border w3-card w3-round w3-btn'>"
                                        +"<h1 class='w3-center redfont'>"+r[x].subabbr+"</h1>"
                                        +"<div class='w3-center w3-tiny'>"+r[x].name+"</div>"
                                        +"<div class='w3-center w3-tiny'><b>Out of</b> "+r[x].outof+"</div>"
                                        +"<div class='w3-center w3-tiny redfont'>"+r[x].termname+"</div>"
                                    +"</div>"
                                +"</div>";
                                
                    }

                    $('#classhws').html(txt);
                });
            txt += "</div>"
            $('#classHWModalCont').html(txt);    
		},
		
		loadFormTeacherEditForm:function(purpose)
		{
		    document.getElementById('editFormTeachersModal').style.display='block';
		}
    };
   
    var summaries = {
        query:"",
        object:"",
        
        showClassTestSummary:function()
        {
            var bits = $('#bits').attr('class');
            
            var classid = $("#classid").attr('class');
			
			this.query = bits+"lib/summaries/overall.php?action=getclasssummary&classid="+classid;
			$("#tabcontainer").html("<img src='"+bits+"Book.gif' style='width:300px' />");
			$.post(this.query,
                this.object,
                function (data, status) {
                     
                    //alert("My Data: " + data + "\nStatus: " + status);
                    r = JSON.parse(data);
                    
                    var classsubs = $("#classsubabbrs").text();
                    
                    var txt = "<table id='testsummarytable' class='w3-tiny w3-white w3-padding w3-table' style='width:1000px'>"; 
                    txt+="<tr class='headings'>"+classsubs+"<td>AVG</td></tr>";
                    
                    for(x in r)
                    {
                        var stdname = r[x].stdname;
                        stdname += "<td style='border:solid 1px black;' class='stdname'>"+stdname+"</td>";
                        var scores = [];
                        var grades = [];
                        scores = r[x].scorevalues.split(",");
                        grades = r[x].scoregrades.split(",");
                        
                        var scorevalues="";
                        var ctr = 0;
                        for(s in scores)
                        {
                            var score = "<div class='score w3-center'>"+scores[s]+"</div>";
                            var grade = "<div class='grade w3-center'>"+grades[ctr]+"</div>";
                            scorevalues += "<td style='border:solid 1px black;font-style:bold'>"+score+grade+"</td>";
                            ctr++;
                        }
                        var stdrow = stdname+""+scorevalues;
                        
                        var stdaverage = "<td class='avg'>"+r[x].stdaverage+"</td>";
                        txt+="<tr class='stdrow'>"+stdrow+stdaverage+"</tr>";
                    }
                    
                    txt += "</table>";
                    
                    $("#tabcontainer").html(txt);
                }
            );
        }
        
    };
    
    var buttons = {
        object:"",
        query:"",
        selectButton:function()
        {
            
            //alert(this);
			var btn = event.target;
            
			var parent = $(btn).parent();
            var ctr = 0;

            if($(parent).attr('id')==$('.assigned').attr('id'))
            {
                if($(btn).hasClass('w3-red'))
                {
                    $(btn).removeClass("w3-red");
                    $(btn).addClass("w3-teal");
                    ctr++;
                }
                if($(btn).hasClass('w3-teal')&&ctr<=0)
                {
                    $(btn).removeClass("w3-teal");
                    $(btn).addClass("w3-red");
                }
			}

            var ctr = 0;
            if($(parent).attr('id')==$('.notassigned').attr('id'))
            {
				if($(btn).hasClass('w3-white'))
                {
                    $(btn).removeClass("w3-white");
                    $(btn).addClass("w3-teal");
                    ctr++;
                }
                if($(btn).hasClass('w3-teal')&&ctr<=0)
                {
                    $(btn).removeClass("w3-teal");
                    $(btn).addClass("w3-white");
                }
			}
        },
        moveButton:function(direction, count)
        {
            //alert(direction);
            if(direction==="r")
            {
                var ctr = 0;
                $('.assigned').children('button').each(
                    function(){
                        if($(this).hasClass('w3-teal')&&count===1)
                        {
                            alert();
                            $(this).removeClass("w3-red");
                            $(this).removeClass("w3-teal");
                            $(this).addClass("w3-white");
                            $('.notassigned').append(this);
                        }
                        if(count>1)
                        {
                            $(this).removeClass("w3-red");
                            $(this).removeClass("w3-teal");
                            $(this).addClass("w3-white");
                            $('.notassigned').append(this);
                            ctr++;
                        }
                    }
                );

                //alert(ctr);
            }
            if(direction==="l")
            {
                $('.notassigned').children('button').each(
                    function(){
                        if($(this).hasClass('w3-teal')&&count===1)
                        {
                            $(this).removeClass("w3-white");
                            $(this).removeClass("w3-teal");
                            $(this).addClass("w3-red");
                            $('.assigned').append(this);
                            
                        }
                        if(count>1)
                        {
                            //$('.notassigned').children(this).remove();
                            $(this).removeClass("w3-white");
                            $(this).removeClass("w3-teal");
                            $(this).addClass("w3-red");
                            $('.assigned').append(this);
                            
                        }

                        //alert();
                    }
                );

               
                //alert(count($('.assigned').children(this)));
            }
        },
        saveSubjectAllocation:function(type,id)
        {
            var bits = $('#bits').attr('class');
			
			if(type==="class"){
				this.query = bits+"lib/classes/stdclass.php?action=savesubjects";
			}
			if(type==="student"){
				this.query = bits+"lib/students/student.php?action=savesubjects";
			}

            var subjects = [];
			var subctr = 0;
            $('.assigned').children('button').each(
                    function(){
						subctr++;
                        var id = $(this).attr('id');
                        subjects.push(id);                      
                    }
                );
				if(subctr<=0){
					//alert("Please select a subejct to assign");
					//exit();
				}

                var termid = $('#thisterm').attr('term');;
				if(type==="class"){
					this.object = {
						classid: id,
						termid: termid,
						subjects: subjects
					}
				}
				if(type==="student"){
					this.object = {
						studentid: id,
						termid: termid,
						subjects: subjects
					}
				}

            $.post(this.query,
                this.object,
                function (data, status) {
                     if(type=='student'){
                        alert("Subject choice was successfully updated!\nPage will reload to reflect changes");
                     }
                     if(type=='class'){
                        alert("List of Subjects taught in class was successfully updated!\nPage will reload to reflect changes");
                     }
                    //history.go(0);
					location.reload(true);
                    ///alert("My Data: " + data + "\nStatus: " + status);
                    r = JSON.parse(data);
                }
            );
        }
    };
   
    var subjects = {
        object:"",
        query:"",
        selectSubjectButton:function()
        {
            
            //alert(this);
			var btn = event.target;
            
			var parent = $(btn).parent();
            var ctr = 0;

            if($(parent).attr('id')==$('.assigned').attr('id'))
            {
                if($(btn).hasClass('w3-red'))
                {
                    $(btn).removeClass("w3-red");
                    $(btn).addClass("w3-teal");
                    ctr++;
                }
                if($(btn).hasClass('w3-teal')&&ctr<=0)
                {
                    $(btn).removeClass("w3-teal");
                    $(btn).addClass("w3-red");
                }
			}

            var ctr = 0;
            if($(parent).attr('id')==$('.notassigned').attr('id'))
            {
				if($(btn).hasClass('w3-white'))
                {
                    $(btn).removeClass("w3-white");
                    $(btn).addClass("w3-teal");
                    ctr++;
                }
                if($(btn).hasClass('w3-teal')&&ctr<=0)
                {
                    $(btn).removeClass("w3-teal");
                    $(btn).addClass("w3-white");
                }
			}
        },
        moveSubject:function(direction, count)
        {
            //alert(count);
            if(direction==="r")
            {
                var ctr = 0;
                $('.assigned').children('button').each(
                    function(){
                        if($(this).hasClass('w3-teal')&&count===1)
                        {
                            $(this).removeClass("w3-red");
                            $(this).removeClass("w3-teal");
                            $(this).addClass("w3-white");
                            $('.notassigned').append(this);
                        }
                        if(count>1)
                        {
                            $(this).removeClass("w3-red");
                            $(this).removeClass("w3-teal");
                            $(this).addClass("w3-white");
                            $('.notassigned').append(this);
                            ctr++;
                        }
                    }
                );

                //alert(ctr);
            }
            if(direction==="l")
            {
                $('.notassigned').children('button').each(
                    function(){
                        if($(this).hasClass('w3-teal')&&count===1)
                        {
                            $(this).removeClass("w3-white");
                            $(this).removeClass("w3-teal");
                            $(this).addClass("w3-red");
                            $('.assigned').append(this);
                            
                        }
                        if(count>1)
                        {
                            //$('.notassigned').children(this).remove();
                            $(this).removeClass("w3-white");
                            $(this).removeClass("w3-teal");
                            $(this).addClass("w3-red");
                            $('.assigned').append(this);
                            
                        }

                        //alert();
                    }
                );

                
                //alert(count($('.assigned').children(this)));
            }
        },
        loadSubjectEditForm:function(type)
        {
			var object = "";
			var bits = $('#bits').attr('class');
			//alert(type);
			if(type==="class"){
				document.getElementById('editClassSubjectsModal').style.display = 'block';
				object = "stdclass";
			}
			if(type==="student"){
				document.getElementById('editStudentSubjectsModal').style.display = 'block';
				
			}
            
            this.query = bits+"lib/subjects/subjects.php?action=list";
            $('.assigned').html('');
            $('.notassigned').html('');
            $.post(this.query,
                this.object,
                function (data, status) {
                    //alert("My Data: " + data + "\nStatus: " + status);
                    r = JSON.parse(data);

                    var mainsubs = [];
                    $('.mainsubs').children('.sub').each(
                        function(){
                            var subid = $(this).attr('id');
                            //alert($(this).attr('id'));
                            mainsubs.push(subid);
                        }
                    );

                    var txt = "";
                    var natxt = "";

                    for(x in r)
                    {
                       
                        if((general.inarray(r[x].ID, mainsubs))){
                            txt += '<button id="'+r[x].ID+'" onclick="subjects.selectSubjectButton()" selected="yes" class="w3-tiny w3-border w3-border-red w3-btn w3-round-large w3-left w3-border w3-padding w3-red" style="margin:5px;">	'+r[x].abbr+'	</button>';
                        }
                        else{
                            natxt += '<button id="'+r[x].ID+'" onclick="subjects.selectSubjectButton()" selected="yes" class="w3-tiny w3-border w3-border-red w3-btn w3-round-large w3-left w3-border w3-padding w3-white" style="margin:5px;">	'+r[x].abbr+'	</button>';
                        }
                    }
                    $('.assigned').html(txt);
                    $('.notassigned').html(natxt);
                }
            );
			
			
        },
        saveSubjectAllocation:function(type,id)
        {
            var bits = $('#bits').attr('class');
			
			if(type==="class"){
				this.query = bits+"lib/classes/stdclass.php?action=savesubjects";
			}
			if(type==="student"){
				this.query = bits+"lib/students/student.php?action=savesubjects";
			}

            var subjects = [];
			var subctr = 0;
            $('.assigned').children('button').each(
                    function(){
						subctr++;
                        var id = $(this).attr('id');
                        subjects.push(id);                      
                    }
                );
				if(subctr<=0){
					//alert("Please select a subejct to assign");
					//exit();
				}

                var termid = $('#thisterm').attr('term');;
				if(type==="class"){
					this.object = {
						classid: id,
						termid: termid,
						subjects: subjects
					}
				}
				if(type==="student"){
					this.object = {
						studentid: id,
						termid: termid,
						subjects: subjects
					}
				}

            $.post(this.query,
                this.object,
                function (data, status) {
                     if(type=='student'){
                        alert("Subject choice was successfully updated!\nPage will reload to reflect changes");
                     }
                     if(type=='class'){
                        alert("List of Subjects taught in class was successfully updated!\nPage will reload to reflect changes");
                     }
                    //history.go(0);
					location.reload(true);
                    ///alert("My Data: " + data + "\nStatus: " + status);
                    r = JSON.parse(data);
                }
            );
        }
    };
    
    var search = {
        object: "",
        liveSearch: function(name)
        {
            var bits = $('#bits').attr('class');
            var query = "";
            //var name = $(this).attr("name");
            
            var searchvalue = $("input[name='"+name+"']").val();
            switch(name)
            {
                case "homeSearchTF":
                    
                    document.getElementById('homeSearchResults').style.display = 'none';
                    
                    if(searchvalue.length>0)
                    {
                        document.getElementById('homeSearchResults').style.display = 'block';
                    }

                    this.query = bits+"lib/home/search.php?action=live&value="+searchvalue;
                    
                    break;
                    
                case "librarySearchTF":
                    
                    document.getElementById('librarySearchResults').style.display = 'none';
                    
                    if(searchvalue.length>0)
                    {
                        document.getElementById('librarySearchResults').style.display = 'block';
                    }

                    this.query = bits+"lib/library/search.php?action=live&value="+searchvalue;
                    //alert(this.query);
                    break;
                    
                case "custodianSearchTF":
                    
                    document.getElementById('custodianSearchResults').style.display = 'none';
                    
                    if(searchvalue.length>0)
                    {
                        document.getElementById('custodianSearchResults').style.display = 'block';
                    }

                    this.query = bits+"lib/library/search.php?action=livecustodian&value="+searchvalue;
                    //alert(this.query);
                    break;

                case "casetitle":
                    if(searchvalue.length)
                    {
                        $('#caseTitleSuggestions').html("");
                    }
                    this.query = bits+"lib/incidents/search.php?action=live&value="+searchvalue;
                    break;

                case "disciplineCaseStd":
                    if(searchvalue.length)
                    {
                        $('#disciplineCaseStdList').html("");
                    }
                    this.query = bits+"lib/students/search.php?action=live&value="+searchvalue;
                    break;
                case "studentSearch":
                    if(searchvalue.length)
                    {
                        $('#studentList').html("");
                    }
                    this.query = bits+"lib/students/search.php?action=live&value="+searchvalue;
                    break;
            }

            $.post(this.query,
                this.object,
                function (data, status) {
                    
                    //alert("My Data: " + data + "\nStatus: " + status);
                    $("#disciplineCaseStdList").show();
					//;
                    var result = JSON.parse(data);
					//alert(result);
                    switch(name)
                    {							
						case "homeSearchTF":
						    var txt = "";
							for(x in result)
							{
								//alert(result[x].paperid);
								txt += '<li class="w3-row w3-small w3-margin-top" onclick="$(\'#homeSearchResults\').hide()">'
                                            +'<div class="w3-large"><a href="'+result[x].link+'">'+result[x].title+'</a></div>'
                                            +'<div class="w3-text-grey w3-row">'
                                            +'<div class="redfont w3-left">'+result[x].restype+'</div>'
                                            +'<div class="w3-left w3-margin-left">'+result[x].details+'</div>'
                                            +'</div>'
                                        +'</li>';
									
								//alert(txt);
							}
							$('#homeSearchResults').html(txt);
							break;
							
						case "librarySearchTF":
						    var txt = "";
							for(x in result)
							{
							    var rightbtn = '';
							    
							    if(result[x].restype=='Book')
							    {
							        rightbtn = '<div class="w3-right w3-margin-right">'
							                    +'  <button onclick=\'library.bookCheckinoutModal(\"'+result[x].resID+'\",\"'+result[x].title+'\")\'>Check out</button>'
							                    //+'  <button onclick=\'library.bookCheckinoutModal(\"1\",\"1\")\'>Check out</button>'
							                   +'</div>';
							    }
							    
								//alert(result[x].paperid);
								txt += '<li class="w3-row w3-small w3-margin-top" onclick="$(\'#librarySearchResults\').hide()">'
								            +'<div class="w3-left">'
                                            +'  <div class="w3-large w3-left"><a href="'+result[x].link+'">'+result[x].title+'</a></div>'
                                            +'  <div class="w3-text-grey w3-row">'
                                            +'      <div class="redfont w3-left">'+result[x].restype+'</div>'
                                            +'      <div class="w3-left w3-margin-left">'+result[x].details+'</div>'
                                            +'  </div>'
                                            +'</div>'
                                            +rightbtn
                                        +'</li>';
									
								//alert(txt);
							}
							$('#librarySearchResults').html(txt);
							break;
							
						case "custodianSearchTF":
						    var txt = "";
						    var rightbtn = '';
							for(x in result)
							{
							    //if(result[x].restype=='Book')
							    //{
							        rightbtn = '<div class="w3-right w3-margin-right">'
							                   +'  <button onclick=\'library.selectCustodianBTN(\"'+result[x].resID+'\",\"'+result[x].title+'\");\'>Select</button>'
							                   +'</div>';
							    //}
							    
								//alert(result[x].paperid);
								txt += '<li class="w3-row w3-small w3-margin-top" onclick="$(\'#librarySearchResults\').hide()">'
								            +'<div class="w3-left">'
                                            +'  <div class="w3-large w3-left"><a href="'+result[x].link+'">'+result[x].title+'</a></div>'
                                            +'  <div class="w3-text-grey w3-row">'
                                            +'      <div class="redfont w3-left">'+result[x].restype+'</div>'
                                            +'      <div class="w3-left w3-margin-left">'+result[x].details+'</div>'
                                            +'  </div>'
                                            +'</div>'
                                            + rightbtn
                                        +'</li>';
									
								//alert(txt);
							}
							$('#custodianSearchResults').html(txt);
							break;
						case "casetitle":
						    var txt = "";
							for(x in result)
							{
								//alert(result[x].paperid);
								txt += '<li class="w3-row w3-margin-top" onclick="$(\'#casetitle\').val(\''+result[x].title+'\');$(\'#caseTitleSuggestions\').html(\'\')">'
                                            +result[x].title
                                        +'</li>';
									
								//alert(txt);
							}
							$('#caseTitleSuggestions').html(txt);
							//document.getElementById('newAssignmentFormModal').style.display = 'none';
							break;
						case "disciplineCaseStd":
						    var txt = "";
							for(x in result)
							{
								//alert(result[x].paperid);
								txt += '<li class="w3-row">'
                                            +'<button onclick="lessonperiod.addStudentToCase(\''+result[x].user_id+'\',\''+result[x].stdname+'\')" class="w3-small w3-round w3-margin-right redtheme w3-card w3-btn"><b>+</b></button>' 
                                            +result[x].stdname
                                        +'</li>';
									
								//alert(txt);
							}
							$('#disciplineCaseStdList').html(txt);
							//document.getElementById('newAssignmentFormModal').style.display = 'none';
							break;
						case "studentSearch":
						    var txt = "";
                            var ctr= 0;
							for(x in result)
							{
                                ctr++;
								//alert(result[x].paperid);
								
                                txt += '<li><div class="exam w3-row">'
                                    +'<img class="w3-left icon w3-round-xxlarge w3-margin-right" src="'+bits+'Resources/Images/student.png" />'
                                    +'<div class="w3-left">'
                                        +'<div class="redfont w3-small">'
                                            +'<a href="'+bits+'student/view?id='+result[x].ID+'&section=academic">'
                                            +result[x].stdname 
                                            +'</a>'
                                        +'</div>'                        
                                        +'<div class="w3-text-grey w3-tiny w3-row">'
                                            +'<div class="w3-left w3-margin"><b>Gender</b>: '+result[x].gender+'</div>'
                                            +'<div class="w3-left w3-margin"><b>Age</b>: '+result[x].age+'</div>'
                                            +'<div class="w3-left w3-margin"><b>Class</b>: '+result[x].stdclass+'</div>'
                                        +'</div>'                        
                                    +'</div>'
                                    +'<div class="w3-right">'
                                    +'<a href="'+bits+'student/view?id='+result[x].ID+'&section=academic" class="redtheme w3-btn w3-text-white w3-round w3-tiny">'
                                        +'view'
                                    +'</a>'                        
                                    +'</div>'
                                +'</div></li>';
									
								//alert(txt);
							}
                            if(ctr>0){
							    $('#studentList').html(txt);
                            }else
                            {
							    $('#studentList').html("<div class='w3-margin w3-padding w3-large'><b>No results were found</b></div>");
                            }
							//document.getElementById('newAssignmentFormModal').style.display = 'none';
							break;
                        
                    }
                });
        }
    };
    
    $(document).ready(function () {

        $pagename = $('#pagename').attr('class');

        switch($pagename)
        {
            case 'newTeachingTT':
                $('.dayperiods').each(function(){
                    var day = $(this).attr('day');
                    var plusbtn = '<br/><button class="plusbtn w3-margin-bottom w3-light-gray w3-border w3-round-large w3-btn" style="width:90%" onclick="timetables.addNewPeriodForm(\''+day+'\')">'
                        +'<div class="period  w3-hide-small  w3-margin-bottom  w3-center" style="margin: 3px;">'
                        + '<h1><b>+</b></h1>'
                        +'</div>'
                    +'</button>';
                    $(this).append(plusbtn);
                });
                break;
            case 'registrations':
                var date = new Date();
                var day = date.getDate();
                var month = date.getMonth()+1;
                var year = date.getFullYear();
                if(month<10) month = "0"+month;
                if(day<10) day = "0"+day;
                var today = year+"-"+month+"-"+day;
                $("#attendanceDate").val(today);
                break;
            case 'classview':
                var xValues = ["Absent", "Sick", "Holiday", "Dropout", "Present"];
                var yValues = [55, 49, 44, 24, 15];
                var barColors = [
                  "#b91d47",
                  "#00aba9",
                  "#2b5797",
                  "#e8c3b9",
                  "#1e7145"
                ];
                
                let element = document.getElementById("stdtakingsubSelect");
                element.dispatchEvent(new Event("change"));
                
                
                new Chart("myChart", {
                  type: "doughnut",
                  data: {
                    labels: xValues,
                    datasets: [{
                      backgroundColor: barColors,
                      data: yValues
                    }]
                  },
                  options: {
                    title: {
                      display: true,
                      text: "Distribution According To Attendance Status"
                    }
                  }
                });
                
                var initAction = $('#initAction').attr('class');
                if(initAction=="TakeAttendance")
                {
                    var classid = $('#classid').attr('class');
                    attendance.showClassAttencanceModal(classid,'Daily');

                    var date = new Date();
                    var day = date.getDate();
                    var month = date.getMonth()+1;
                    var year = date.getFullYear();
                    if(month<10) month = "0"+month;
                    if(day<10) day = "0"+day;
                    var today = year+"-"+month+"-"+day;
                    $("#attendanceDate").val(today);
                }
                break;
            case 'newscheme':
                
                var days = ["Sun","Mon","Tue","Wed","Thur","Fri","Sat","Mon"];
                var fd = new Date($("#weekfrom").attr("date"));
                $("#weekfrom").html(days[fd.getDay()]+", "+fd.getDate()+"/"+(fd.getMonth()+1)+"/"+fd.getFullYear());
                
                fd.setDate(fd.getDate()+6);
                $("#weekto").html(days[fd.getDay()]+", "+fd.getDate()+"/"+(fd.getMonth()+1)+"/"+fd.getFullYear());
                $("#weekto").attr("date",fd.getFullYear()+"/"+(fd.getMonth()+1)+"/"+fd.getDate());

                break;
        }

    });
