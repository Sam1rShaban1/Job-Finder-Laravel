@include('mail.components.header')

<h1>{{ $mailData['title'] }}</h1>
<p>Dear {{ $mailData['jobSeekerName'] }},</p>
<p>We are pleased to inform you that your interview for the <strong>{{ $mailData['jobTitle'] }}</strong> position at <strong>{{ $mailData['companyName'] }}</strong> has been scheduled.</p>
<p><strong>Interview Details:</strong></p>
<ul>
    <li><strong>Date:</strong> {{ $mailData['interviewDate'] }}</li>
    <li><strong>Time:</strong> {{ $mailData['interviewTime'] }} ({{ $mailData['timeZone'] }})</li>
    <li><strong>Location/Link:</strong> {{ $mailData['interviewLocation'] }}</li>
    <li><strong>Contact Person:</strong> {{ $mailData['contactPerson'] }}</li>
</ul>
<p>Please make sure to be prepared and arrive on time. If this is a virtual interview, ensure you have a stable internet connection and the required software installed.</p>
<p>If you have any questions or need to reschedule, please contact <a href="mailto:{{ $mailData['contactEmail'] }}">{{ $mailData['contactEmail'] }}</a> as soon as possible.</p>
<p>We wish you the best of luck and look forward to seeing you!</p>

@include('mail.components.footer')
