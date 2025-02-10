@include('mail.components.header')

<h1>{{ $mailData['title'] }}</h1>
<p>Dear {{ $mailData['jobSeekerName'] }},</p>
<p>Thank you for applying for the <strong>{{ $mailData['jobTitle'] }}</strong> position at <strong>{{ $mailData['companyName'] }}</strong> through Job Finder.</p>
<p>Your application has been successfully submitted and forwarded to the employer. They will review your application and contact you directly if you are shortlisted.</p>
<p><strong>Next Steps:</strong></p>
<ul>
    <li>You can track your application status in your dashboard.</li>
    <li>Keep your profile updated to improve your chances of getting hired.</li>
    <li>Explore more job opportunities on our platform.</li>
</ul>
<p>Wishing you the best of luck!</p>

@include('mail.components.footer')
