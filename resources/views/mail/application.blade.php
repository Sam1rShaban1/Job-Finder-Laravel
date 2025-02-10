@include('mail.components.header')

<h1>{{ $mailData['title'] }}</h1>
<p>Dear {{ $mailData['jobSeekerName'] }},</p>
<p>Thank you for applying for the <strong>{{ $mailData['jobTitle'] }}</strong> position at <strong>{{ $mailData['companyName'] }}</strong> through <strong>Job Finder</strong>. We are pleased to confirm that your application has been successfully submitted.</p>

<p><strong>What Happens Next?</strong></p>
<ul>
    <li>Your application has been forwarded to the employer.</li>
    <li>The employer will review your application and may contact you directly if you are shortlisted.</li>
    <li>You can track your application status in your <a href="{{ $mailData['dashboardLink'] }}">Job Finder dashboard</a>.</li>
</ul>

<p>We encourage you to keep your profile updated and explore more job opportunities that match your skills.</p>

<p>We wish you the best of luck with your job search!</p>

@include('mail.components.footer')
