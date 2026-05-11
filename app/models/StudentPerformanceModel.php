<?php

class StudentPerformanceModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getStudentOverview($studentId)
{
    $sql = "
        SELECT 
            s.id,
            s.candidate_name,
            COUNT(DISTINCT m.subject_id) AS total_subjects,
            COUNT(DISTINCT m.exam_id) AS total_exams,
            ROUND(AVG(m.marks_obtained), 2) AS avg_marks
        FROM students s
        LEFT JOIN marks m ON s.id = m.student_id
        WHERE s.id = ?
        GROUP BY s.id
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$studentId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function getAttendancePercentage($studentId)
    {
        $sql = "
            SELECT 
                COUNT(*) AS total_days,
                SUM(CASE WHEN status = 'Present' THEN 1 ELSE 0 END) AS present_days,
                ROUND((SUM(CASE WHEN status = 'Present' THEN 1 ELSE 0 END) / COUNT(*)) * 100, 2) AS attendance_percentage
            FROM attendance
            WHERE student_id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$studentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getWeakSubjects($studentId)
    {
        $sql = "
            SELECT 
                sub.subject_name,
                ROUND(AVG(m.marks_obtained), 2) AS avg_marks,
                ROUND((AVG(m.marks_obtained) / MAX(e.total_marks)) * 100, 2) AS percentage
            FROM marks m
            INNER JOIN subjects sub ON m.subject_id = sub.id
            INNER JOIN exams e ON m.exam_id = e.id
            WHERE m.student_id = ?
            GROUP BY sub.id
            HAVING percentage < 50
            ORDER BY percentage ASC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$studentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStudentExamTrend($studentId)
    {
        $sql = "
            SELECT 
                e.exam_name,
                e.exam_date,
                ROUND(AVG(m.marks_obtained), 2) AS avg_marks
            FROM marks m
            INNER JOIN exams e ON m.exam_id = e.id
            WHERE m.student_id = ?
            GROUP BY e.id
            ORDER BY e.exam_date ASC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$studentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}