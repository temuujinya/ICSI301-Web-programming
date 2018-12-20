<?php

if (isset($_POST['student_id'])) {
    header('Content-Type: text/xml');
    $id = $_POST['student_id'];

    $student = find_student_by_id($id);

    $courses = find_all_course();
    $course_enrollments = find_all_course_enrollment_by_student_id($id);
    $returnText = '<data>';

    $returnText .= '<student_id>'.$student['student_id'].'</student_id>';

    $returnText .= '<course_enrollments>';
    foreach ($course_enrollments as $enrolled) {
        $returnText .= '<enrolled>';
        $returnText .= '<course_id>'.$enrolled['course_id'].'</course_id>';
        $returnText .= '</enrolled>';
    }
    $returnText .= '</course_enrollments>';
    $returnText .= '<courses>';

    foreach ($courses as $course) {
        if ($course['program_id'] == $student['fk_program_id']) {
            $returnText .= '<course>';
            $returnText .= '<course_id>'.$course['course_id'].'</course_id>';
            $returnText .= '<program_id>'.$course['program_id'].'</program_id>';
            $returnText .= '<course_name>'.$course['course_name'].'</course_name>';
            $returnText .= '<credit>'.$course['credit'].'</credit>';
            $returnText .= '</course>';
        }
    }

    $returnText .= '</courses>';
    $returnText .= '</data>';

    echo $returnText;
}