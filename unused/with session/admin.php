<?php
session_start();

// التحقق من الجلسة والصلاحيات
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.html?error=4"); // إعادة التوجيه إلى صفحة تسجيل الدخول مع رسالة خطأ
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الإدارة</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Tajawal', Arial, sans-serif;
            background: url('images/background.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .container {
            text-align: center;
            background: rgba(0, 0, 0, 0.6);
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            max-width: 800px;
            width: 90%;
        }

        .button {
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background: rgba(0, 123, 255, 0.8);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .button:hover {
            background: rgba(0, 123, 255, 1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        table th {
            background: rgba(0, 0, 0, 0.8);
        }

        table td {
            background: rgba(0, 0, 0, 0.6);
        }

        table td button {
            padding: 5px 10px;
            font-size: 0.9rem;
            color: #fff;
            background: rgba(255, 165, 0, 0.8);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-right: 5px;
        }

        table td button:hover {
            background: rgba(255, 165, 0, 1);
        }

        table td button.delete {
            background: rgba(255, 0, 0, 0.8);
        }

        table td button.delete:hover {
            background: rgba(255, 0, 0, 1);
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #fff;
            text-decoration: none;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 1px 0;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>لوحة الإدارة</h1>
        <p>مرحباً، <?php echo htmlspecialchars($_SESSION['username']); ?>! لديك صلاحية الإدارة.</p>
        <button class="button" onclick="addUser()">إضافة مستخدم جديد</button>
        <a href="admin_page.php" class="back-link">عودة إلى واجهة مدير النظام</a>

        <table>
            <thead>
                <tr>
                    <th>الرقم التعريفي</th>
                    <th>اسم المستخدم</th>
                    <th>الصلاحية</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody id="userTable">
                <?php
                // الاتصال بقاعدة البيانات
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "user_management";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id, username, role FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . htmlspecialchars($row["username"]) . "</td>";

                        // تحويل الصلاحية إلى نص مفهوم
                        switch ($row['role']) {
                            case 'admin':
                                $usrole = "مدير نظام";
                                break;
                            case 'manager':
                                $usrole = "مجلس إدارة";
                                break;
                            case 'user':
                                $usrole = "مدير إدارة فروع";
                                break;
                            case 'employ':
                                $usrole = "موظف إدارة فروع";
                                break;
                            default:
                                $usrole = "صلاحية مفقودة";
                                break;
                        }

                        echo "<td>" . $usrole . "</td>";
                        echo "<td>
                                <button class='edit' onclick=\"editUser(" . $row['id'] . ")\">تعديل</button>
                                <button class='delete' onclick=\"deleteUser(" . $row['id'] . ")\">حذف</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>لا توجد بيانات</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function addUser() {
            window.location.href = "add_user.php";
        }

        function editUser(userId) {
            window.location.href = "edit_user.php?id=" + userId;
        }

        function deleteUser(userId) {
            if (confirm('هل أنت متأكد من حذف المستخدم؟')) {
                window.location.href = "delete_user.php?id=" + userId;
            }
        }
    </script>
    
</body>
<footer>
    <p>Powered by <strong><a href="https://www.m1oslem.com" target="_blank">Eng Muslim Al-Shamary</a></strong></p>
</footer>
</html>
