<html>
<body>
<object data="{{asset('seekers/cvs/'.getDomainRoot().'/'.$seeker->cv_resume)}}" type="application/pdf" style="width:50%;margin-left:25%;height: 96vh;">
    <embed src="{{asset('seekers/cvs/'.getDomainRoot().'/'.$seeker->cv_resume)}}" type="application/pdf" />
</object>
</body>
</html>