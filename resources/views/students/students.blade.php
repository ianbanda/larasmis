@foreach ($students as $student)
    {{count($student)}};
@endforeach
<?php 
    print_r($students);
?>