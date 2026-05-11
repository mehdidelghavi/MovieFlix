<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $data['title'] ?? config('app.name') }}</title>
</head>

<body style="margin:0;padding:0;background-color:#0f0f0f;
             font-family:Tahoma,Arial,sans-serif;
             direction:rtl;color:#ffffff;">

<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#0f0f0f">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0"
       style="margin:40px 0;background:#1a1a1a;border-radius:12px;overflow:hidden;">

{{-- HEADER --}}
<tr>
<td align="center" style="background:#000;padding:25px;">
    <h1 style="margin:0;color:#e50914;font-size:28px;letter-spacing:2px;">
        🎬 {{ config('app.name') }}
    </h1>
    <p style="color:#aaa;font-size:13px;margin-top:8px;">
        دنیای فیلم و سریال بدون محدودیت
    </p>
</td>
</tr>

{{-- HERO IMAGE --}}
<tr>
<td>
    <img src="{{ asset('assets/template/assest/logo/film.ico') }}" width="100%" style="display:block;">
</td>
</tr>

{{-- CONTENT --}}
<tr>
<td style="padding:30px;line-height:1.9;color:#ddd;font-size:15px;">

    <h2 style="color:#ffffff;margin-top:0;">
        سلام {{ $data['email'] ?? 'دوست عزیز' }} 👋
    </h2>

    {!! $data['content'] ?? '<p>متن ایمیل شما اینجا قرار می‌گیرد.</p>' !!}

</td>
</tr>

{{-- ACTION BUTTON --}}
@isset($data['link'])
<tr>
<td align="center" style="padding-bottom:35px;">
    <a href="{{ $data['link'] }}"
       style="background:#e50914;
              color:#fff;
              padding:14px 35px;
              text-decoration:none;
              border-radius:50px;
              font-weight:bold;
              display:inline-block;
              font-size:15px;">
        رفتن به صفحه
    </a>
</td>
</tr>
@endisset

{{-- FOOTER --}}
<tr>
<td style="background:#000;padding:20px;text-align:center;font-size:12px;color:#777;">
    © {{ date('Y') }} {{ config('app.name') }}  
    <br>
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>
