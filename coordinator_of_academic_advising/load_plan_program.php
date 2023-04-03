<?php
    // Include the database configuration file
    include "../login/config.php";

    // Fetch all levels from the database
    $qry = $conn->query('SELECT `Id_Level`, `Name_Level` FROM `table_levels` ORDER BY Id_Level ASC');

    // Initialize variable
    $bodyPlan = '';

    // Loop through each level and generate the HTML
    while($row = $qry->fetch_assoc()) {
        $bodyPlan .= '<h3><center>'.$row["Name_Level"].'</center></h3>';

        $bodyPlan .= '<table class="table table-hover"><thead><tr style="background-color:#00bfff;"><th>المادة</th><th>عدد السلاعات المعتمدة</th><th>نوع المادة</th><th>المادة المتطلبة</th><th>الاجراء</th></tr></thead><tbody>';

        // Fetch all courses from the database
        $qry2 = $conn->query("SELECT `Id_Course`, CONCAT(`Course_Code`, '--', `Name_Course`) Name_Course FROM `table_courses` ");

        // Initialize variable
        $courseOptions = '';
        $courseOptions .= '<option value="" class="Course"></option>';

        // Generate the course options HTML
        while($row2 = $qry2->fetch_assoc()) {
            $courseOptions .= '<option value="'.$row2["Id_Course"].'" class="Course">'.$row2['Name_Course'].'</option>';
        }

        // Generate the row data HTML
        $rowData = '
        <tr>
            <td>
                <select class="form-control" name="course" id="course">
                    '.$courseOptions.'
                </select>
            </td>
            <td>
                <input type="text" class="form-control" id="Hour_Plan_Credit" name="Hour_Plan_Credit" required>
            </td>
            <td>
                <select class="form-control" name="type_course" id="type_course">
                    <option value="1" class="type_course">اجباري</option>
                    <option value="2" class="type_course">اختياري</option>
                </select>
            </td>
            <td>
                <select class="form-control" name="pre_request" id="pre_request">
                    '.$courseOptions.'
                </select>
            </td>
            <td>
                <button class="btn btn-sm btn-danger remove_row_selected">حذف</button>
            </td>
        </tr>
    ';

        // Add the row data HTML to the table body
        $bodyPlan .= $rowData;

        // Add the last row HTML to the table body
        $bodyPlan .= '<tr class="last-row"><td colspan="3"><button class="btn btn-primary floating-action-button">+</button></td></tr></tbody></table>';
    }

    // Output the HTML
    echo $bodyPlan;
?>