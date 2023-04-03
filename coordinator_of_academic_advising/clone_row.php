<?php 
    // Include the database configuration file
    include "../login/config.php";

    // Fetch all courses from the database
    $qry2 = $conn->query("SELECT `Id_Course`, CONCAT(`Course_Code`, '--', `Name_Course`) Name_Course FROM `table_courses` ");

    // Initialize variables
    $courseOptions = '';
    $rowData = '';

    // Create the course options HTML
    $courseOptions .= '<option value="" class="Course"></option>';
    while($row2 = $qry2->fetch_assoc()) {
        $courseOptions .= '<option value="'.$row2["Id_Course"].'" class="Course">'.$row2['Name_Course'].'</option>';
    }

    // Create the row data HTML
    $rowData .= '<tr>
                    <td>
                        <select class="form-control smaller" name="course" id="course">'.$courseOptions.'</select>
                    </td>
                    <td>
                        <input type="text" class="form-control smaller" id="Hour_Plan_Credit" name="Hour_Plan_Credit" required>
                    </td>
                    <td>
                        <select class="form-control smaller" name="type_course" id="type_course">
                            <option value="1" class="advisor">اجباري</option>
                            <option value="2" class="advisor">اختياري</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control smaller" name="pre_request" id="pre_request">'.$courseOptions.'</select>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-danger remove_row_selected">حذف</button>
                    </td>
                </tr>';

    // Output the row data HTML
    echo $rowData;
?>

<style>
    .form-control.smaller {
        font-size: 70%;
        padding: 0.375rem 0.75rem;
        margin: 50px;
    }
</style>