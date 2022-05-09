
Reset Password:
1) Show Forgot Password VIEW
=> input: Email
=> ResetPasswordController: showForgotView
=> Route: password.forgot? - method (get)

2) Send Reset Password Link
=> body: email
=> Route: password.email? (POST)
=> ResetPasswordController: sendResetEmail

3) Reset Password VIEW
=> inputs: token, email, password,password_confirmation
=> Route: password.reset - (GET)
=> ResetPasswordController: resetPassword

4) Reset Password
=> body: token, email, password(confirmed)
=> Route: password.update?
=> ResetPasswordController: updatePassword - POST