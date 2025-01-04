<?php
// التحقق من أن الطلب تم إرساله باستخدام POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // الحصول على البيانات المُدخلة في النموذج
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // التحقق من أن الحقول ليست فارغة
    if (!empty($name) && !empty($email) && !empty($message)) {
        // التحقق من صحة البريد الإلكتروني
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // إعداد البريد الإلكتروني
            $to = "elsawah.demo@gmail.com"; // ضع بريدك الإلكتروني هنا
            $subject = "رسالة جديدة من نموذج الاتصال";
            $body = "الاسم: $name\n";
            $body .= "البريد الإلكتروني: $email\n";
            $body .= "الرسالة:\n$message\n";

            $headers = "From: $email\r\n";

            // إرسال البريد الإلكتروني
            if (mail($to, $subject, $body, $headers)) {
                echo "تم إرسال رسالتك بنجاح. شكرًا لتواصلك معنا!";
            } else {
                echo "حدث خطأ أثناء محاولة إرسال الرسالة. حاول مرة أخرى لاحقًا.";
            }
        } else {
            echo "الرجاء إدخال بريد إلكتروني صالح.";
        }
    } else {
        echo "الرجاء ملء جميع الحقول.";
    }
} else {
    echo "طريقة الإرسال غير صحيحة.";
}
?>