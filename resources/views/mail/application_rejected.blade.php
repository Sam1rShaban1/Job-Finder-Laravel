@include('mail.components.header')

<h1>{{ $mailData['title'] }}</h1>
<p>Dear {{ $mailData['jobSeekerName'] }},</p>
<p>Thank you for taking the time to apply for the <strong>{{ $mailData['jobTitle'] }}</strong> position at <strong>{{ $mailData['companyName'] }}</strong>. We appreciate your interest in this opportunity and the effort you put into your application.</p>
<p>After careful consideration, we regret to inform you that we have decided to proceed with other jobfinders at this time. However, we encourage you to continue exploring opportunities on our platform, as new positions are posted regularly.</p>
<p><strong>Next Steps:</strong></p>
<ul>
    <li>Keep your profile updated to improve your chances for future opportunities.</li>
    <li>Browse new job postings on <a href="{{ $mailData['jobBoardLink'] }}">Job Finder</a>.</li>
    <li>Enhance your skills and experience to increase your chances of success in upcoming applications.</li>
</ul>
<p>We appreciate your interest and encourage you to apply for future openings that match your qualifications.</p>
<p>We wish you the very best in your job search!</p>

@include('mail.components.footer')
