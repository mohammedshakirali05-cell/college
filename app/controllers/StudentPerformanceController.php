<?php

class StudentPerformanceController
{
    private $model;
    private $db;

    public function __construct($db)
    {
        // 🔥 IMPORTANT DEBUG CHECK
        if (!$db) {
            die("DB connection is NULL ❌");
        }

        $this->db = $db; // ✅ STORE CONNECTION
        $this->model = new StudentPerformanceModel($db);
    }

    public function dashboard()
    {
        $studentId = $_GET['student_id'] ?? null;

        // ✅ FETCH STUDENTS (NOW WORKS)
        $stmt = $this->db->query("SELECT id, candidate_name FROM students");
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // EXISTING LOGIC (UNCHANGED)
        $overview = $studentId ? $this->model->getStudentOverview($studentId) : null;
        $attendance = $studentId ? $this->model->getAttendancePercentage($studentId) : null;
        $weakSubjects = $studentId ? $this->model->getWeakSubjects($studentId) : [];
        $trend = $studentId ? $this->model->getStudentExamTrend($studentId) : [];

        $pageTitle = 'Student Performance Tracking';
        include __DIR__ . '/../views/performance/dashboard.php';
    }
}