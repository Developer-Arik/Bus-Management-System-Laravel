@extends('master')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<!-- Owl Carousel -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<style>
    .owl-carousel {
    width: 100%;
    height: 60vh;
}

.slide {
    width: 100%;
    height: 60vh;
    position: relative;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
}

.slide::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 60vh;
    background-color: rgba(0, 0, 0, 0.5);
}

.slide-1 {
    background-image: url(bg-1.jpg);
}

.slide-2 {
    background-image: url(bg-2.jpg);
}

.slide-3 {
    background-image: url(bg-3.jpg);
}

.slide-content {
    text-align: center;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #fff;
    padding: 0 20%;
}

.slide-content h1 {
    font-family: "Anton", serif;
    font-size: 45px;
    text-transform: uppercase;
}

.slide-content p {
    font-family: "Lato", serif;
    font-size: 18px;
    margin-bottom: 20px;
}

.slide-content button {
    font-family: "Roboto", serif;
    font-size: 25px;
    text-transform: uppercase;
    font-weight: bolder;
    padding: 10px 25px;
    border: none;
}

.owl-dots {
    width: 100%;
    text-align: center;
    position: absolute;
    bottom: 1%;
}

.owl-dots span {
    width: 20px !important;
    height: 20px !important;
}

.owl-dots button {
    border: none !important;
    outline: none !important;
}

.owl-nav button {
    border: none !important;
    outline: none !important;
}

.owl-prev, .owl-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #fff !important;
    font-size: 65px !important;
    font-weight: bolder !important;
    background:none !important;
}

.owl-prev {
    left: 1%;
}

.owl-next {
    right: 1%;
}
.owl-carousel .owl-item img{
    display: block;
    width: 100%;
    height: 100%;
}
</style>
@endsection
@section('body')
<div class="owl-carousel owl-theme">
    <div class="slide slide-1">
        <img src="http://www.observerbd.com/2014/12/05/1417794510.jpg" alt="">
    </div>
    <div class="slide slide-2">
        <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMSEhUTExIWFhUXGBgXGBcXGBcYFRcYFxYWFxYYFxgYHyggGBolGxcVITEhJSkrLi4uFx80OTQtOCgtLisBCgoKDg0OGhAQGi0lHyUtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAKgBLAMBIgACEQEDEQH/xAAcAAACAgMBAQAAAAAAAAAAAAAEBQMGAAECBwj/xABEEAABAwEFBAgDBAgFBQEBAAABAgMRAAQFEiExBkFRcRMiMmGBkaGxUsHRFCNCcgcVMzRigpLwFiRTsuFDY6LC4vFE/8QAGwEAAgMBAQEAAAAAAAAAAAAAAgMAAQQFBgf/xAA9EQABAwIDBQMJBgUFAAAAAAABAAIRAwQSITEFE0FRYXGRoRQiQlKBscHR8AYVIzJTsjM0YsLhJUNjcpL/2gAMAwEAAhEDEQA/APcKysrJqKLdarJrKiiysrKyoot1lardRRZWq3XM1FFs0Jare23kpYB4b6QbTbYNWWUp67gnIHqg95G/uFeaK2uW48VqIlWUFMCOA3irgxkjpimXfiGB2SvX2L6QT1iAOMzRSbzaP4xXmjt5gpCkg56DfI3UKb0d3smO5QNJDyF1Ts+kcw4j2L1lNsbOi0+ddh1J0I8xXkgvwjVt0fyz7VKjaJHxKTzCh8qm86IDs1vB/eF61NBfZG0lRgYlmVExJrzpnaNO58f1fWjBfpV+MK5waveIDst/BwKbX/dxHXSYUJMp10yH98apBvQtplaZWTmInX2p0q9ZMEDL4SR7UK6hhcylQJOZCpPrVPpF+i4bqrQ4g6zHildndUspUMSdxy6og1dthnkKxz2hme/lSFm7mTEOLCZlQAEnx3VY7sasDXZQoHiokn3pTGFrpWxttVc0PaJB0Sq+LUC84SOoFeCinQedWS4rKlwB0qJPAZJHcK24ixOiFJREznIzO+pbLZktghlxASdxUcuRnKip0g0zI4+KA0njUI2229tkDEY3ADM+QpeNoEqcSlIkK1MGRurlV3KMymSd4WCfUUAxdbiFyQogGQCk8eImre6rMNHFUQo9pbBYnlKW6teJMTh3RwBGtUly52rQ+UWcqXEKOIRmTMEHdFegC6iXytyA2uCRkBiTEDOgb/bFmk2VuC8oFa0yqIyAEThoHM9IiOwZodVXbyDTTX2YIW45iMrbTGGVdUDXxFPtlLSp1CVJxsstEpSgj9pvWVE6ZndRuy1whgrcLocKpAjsgTMx8VTbS2ro2VJQiZGYGQjfpvoy7AzEcuiiBve/20gwElYBCSIIAqqqvYYw4sFUmJJEppTa+o2XESIVBGRPhwFKLVbOlcIGSCBO/DOvcDXNL6lQ+cfZ4ol6B0zFmaWWnvvHh1JAVB/5rz61WV7pShQDi15kwSZ3jPfRi32xhwpBKTlhMqHefrTSwWQ9IXVrThggFJkpJEEcJ0pm9c5sRkM/rtKEgASkgs76Diz6MHClMkjXMRvFHm60qC3CYKowiSI0mE8OdSJ7RCZIGRI01mO+RS+/nVqUP4oyEiOFAK1QwAEIdlkE8tL6kEwUJiNwOeW4ail1ofBVKnRPgPSl1htTq8SUkHD1cxJyyPgONbF2WhZP3CVYSUyoZ5fLOrFs8jp9c1InMr3y971RZ0YlHPcnerlVXt+2ZJKEpKDGuqp3ADdzp5/h9JkrWtajvJ5Tlp5VXV3+y1alMfZyMZKOkCcRECJiJium4OPFESUJ/jF9G/HnwGY4SPejkfpA6sqs5HEz1ar96tdGog4Y3KAjEOIg5UYix2dacQfLSgAejchScxkmBqDSWOcZzQglWqz7a2VQHWUDlII0mnbVvaUYS4knhIrxh/B0hhSgnjAmRlpuFMbntJsznSBCHU7ioxETodx7qc16IPK9grKS3DtAm1JCggp4glJjnBppaX0tpKlEBIEkmmBMGa6ccCQSSABmSdBVQt98P2xZZsYhGi3jkOQP9nlQl83mHxjfWWrKM0oH7V6N8bk95oCzX/bFkosjLDLKMkpUQVr4lJ7JPjRhvFA5yR7eWduxtBlCsTy81rOuHu4An2qhJX1/Kmm1l5OWh4rdEqGsApIjLNNJWHUzkD5imkwlgTqr1c65wcRjHqKcFsd/nVQsN8lvCkIEqV2pnKrfgPx+YrnVWwZXqrGs2pSAGoAXGAfxAcZFawDifEVstnin1rClX8PgaVJW+FEqzpOuE801Cq62z+BHtRSUn4fWo7UshJ6pE5aTViSYSqxZSpueRoCkP6sSCYSoflWfrXRsaxo68nxCh6g0UCMsiB+U4qk6ccY5giugF8+L3Eye1LlvvtR/mCZ0lCT5xFdovq0D8bauYUk1l+I6qD+b/cKVKs47x4mlim14J7V3WXVW3ptY3TCPEA/FPW9o3d7aT+VY9jU7e1RHaZcHeIPsaSXdcbtoxdCCrBEiRv015Vlp2dtqNGVnwB9qhtxzTxtZ+hAKsrW2iBqpaeYUKZ2bblJ0tA8/rXnLrdqT2mXP6VUK/aCO215gfMUBoO4FMG0qLvzs9y9iY2wJ/wColXOKLRtID2m0H0rw5Fob+COWXsanTbEjRa08lK+dUWVQr31i/Vsd690a2gb/ANNQ/KqfQ1Oq97K4IcB5qHzFeFt3u4OzaFeOE0W1f9oGjqVcwR7UJ3sZiVNzYv0dHt+a9VRs1dylYkO4ZEYcfVPMKoS27BtrcxtupKYyRomRpOE515+3tS8O02hXJX1olra4jtNKT+X/AOTSsuLUX3bSd+Sontq2HtCHMaUgSIOEZcuVMLvujo0FtaBBOeR8JpHZtuAI+9cTzKh/uFNbPt6To8lXcqDVB9MHEAQlu2PVP5XNKY/qps4zhzUQT3ECBHhUb1ztONlCk9UR3HzrpnbISCpps96cjTBvbCzKHXZI8jTxWonX3LM7Y943PB3ZpULAhpGBCQATnlJM6+dd4iMsNE2+8bMuC0siTmkjhQwtiDnCfOiddU2aeCyOtLhpgsPcVe+mDiDhUJjUZwSPWqlel3EEuh1a1oBxgJAOY5aTSRjbp1knE2jDkARPDLnxo+59sftK1JXIGowQN8GZ4CpiaUvGHJbtFZxkMSXFFI06sE7o3ZRRHTS3hW0hYADYVggoUd5ykwPaiXLW1ZlgOKC+jIUkkhQW0onfxTOnEU8vllu0tlSEqHZUpwSkYU5xnmokEjIb6AUwCSFcKm2y7G0phKg6oGFBGsz+EfDSxbKkgwrLIxMEH8u8irPdLCSsoIKBAUXNyW4IwqnQnKlV43zZU2jo2BijtKUTJPEA6DOoacCQmUaJrPDBAJ5oN5RQkKGJKzGnoT/fCrO6l5VkDrylKQnCGwr8a1qCQtY3pSTkN9Kft1m6QBaUqMiSQo5TvNWj9I1pCbvVhIzwYeBzBo6OaZcWrrcw/ik943Uw6s2ZKx1YNotLpkkkdVpGY4zAgARUF83OLAyhaXMUKCQAAlOYJBiTOcVQFXk6sKxKSeQ086s9utyizKlYoYSAk8ejIxE9w9SK1xHFYyZCpdvhTpUT4yfGoRaAMhB78pH1oG0OYj3VK3BM7qBMbEQmaCCUxqDMb91ML4vF9CxhWQCkGABA8xXF03WlwYiT1TIA70io76VCh+X50hzg54Yeq61JlSjaurtMThj2SFD/AIhtA1UfFINSM7TvkhPVJOWaY9jS0zhJ4VzYu2nnVmiyJSqW0K5cATqQrIq+bSkqBabISJkEjyyoG0bWLJH3WXco/MUdan4DiSDprlGYqr2vtabqVbtBGIiNPcte16kDcB0gzPTPTROm9qRvQoeIopG0iCpKVBScUQVDIzpnVZYAJGXGircPu0/y+hrSdYXm3W7MQbzVo2jIwI7vrVbdtsKPCrBff7NPfFV95tHwK5g0q2d+H7V2tr0gy4wjg1vy+Cuv6I7UFPWjEoAFKIBIGhP1r0/CI18jNfOSmm+KxUiHo7L7qf5lD2rSCuSWyvoYs91Qu3Y0vtIQeaQa8Ibva0o7NsdEfxH50dZdrben/wDtUe5UH5VMSrAea9atGzFjVqw3/SBQD2wNiWJ6ED8pIrz9G3dvTn0jSjpmjOmFn/SRbR2mmVeY9jVyFC1yd2n9GFkV2VLT4z71RtudlUWAt4FlYXOoAiOWtWpr9Jzv47In+VR+dVzbracW5DYDK2y2STiIIM8IqYgVbQ8FVBLmmZ86Z2ZmUklZEUpVMiaYsWjIpGtLMpoUikHc5l31pLClfAeYH0qFRMRoahs7hC8uVCYKNtV40J8UX0ax+D+lRHsa2i2uJ0U6PGfcVy1jz7vbfXdjKlSJzFK3bCMwtLby4Zo4qZF9uD/qf1J+hqUbQL4t+avpUNqRBA1ykzQnSJ+FNAaFI8FpG17puUqy2t0KJJVJgKjdi4wNBG6jGrMW20OwAhwzmchMSAO6stONLKFLbBCkYW1hI6M4sji/iTn5VNe7bqQ21iJThCQkwTMzlGo0g1ZbkuJC6tvRDoilQc+8zAScsxHV18KtKNpLQQ62ts4UkpWoxDUxCUEZExGR41UbDd6UOhK34WRmhH4e5StxjhR9rtzi21N2U4ktlKsGUSFYSpSju8zRs1hafJ6jaW9jJXFtSVMKtNpKcCElSGchOEdVTgHaVkMjpXh6LYty0qeVqtZJ945Vf9rkIbsDQSR0rpPSqy60ZmBrqRnlpXmyIEZmczqTrHlT0oZkK7M55fEQO/NXvXpW2tgm63EYiMDQMjU4AMj3V5JsnaFB1tOZAUVEgiernlPKrrt5tK99lNmUgY3QClaTkW+8fFypFGmWSOq6m1LkVnMdp5vvJ+S82sDmJJnWpH7S4cQLmSgBHEJyA9KWshxJMA8DXDzh8f70rQXcFyw1dLb75qdtI0HdQaFEAk6VOy8ZnjVIgJVw2ZPVWOXsaXXymXEpAmYHrRmzzkY+Q+dD299Lb7S1dlJSTvMBW6sg/mfrkvQPH+kg9n7iubVdMNnqr8RUQu8ICVgHUZwRFXC17ZWZTa0gqBUkgSg6kZUmvS923LKEdOVLGGEBGFIjXPfFbC0aLzzKhaQ6OM9yV213EtUaYQPepF3YyoTiUDAmglHrK/LXoNmvux9GkFxuQlIIgagb5FKptIADenRALl1Wo6q/Mug96odusDaEApMnXnMVFfiQmztxwPyptfF5hxbiElJTnhhKdOYpPtAf8u3yP/rS3E7xoPvngupbBrqFZxGYDf3NTe9lSyOQ9qUrdkITGuVMrwP+XB/LS+wuJwkR1jlPdwHCgss6Z7Vp282Llv8A1HgSuzdi4kFJH5hXH6tc+HyIo1LRAEjTdXK7QE6qArUGlcfE3khxd5EEp50Na7LmDg11gVO/eSfi9aHF755FVEKZlQub9QoVWZBAJ3TpOtcN2VAOayNPxHxo9l4pCpP4z61zaLVKTyO4VTmEGFbS0oZ9lIKQlw5zJkEd1RIQsmA5pyrqwMYW+kkEk5AiRAo1tSSJUhHtQw5UACM0PbGlNhCsaVhSsOmYymda0lwhWSUHPUgA+gqO9imEFIjrjeansqUqKgoTpvijaqcBMBRuqVJltJ4xlQuNIP7MjPjTYso3YvQ0vtzmEhIkzxAnwoUUZaqVt7/tq8DOtQFSErnrJ8KLwhOWOCOKajIUsA40jLQihwxwRQZUD1rxE/eAcxnQ+AfEjzqa0WBSzJKDQxsKhlhFQQqcwq9O3gejwsqHQupPSN/hSeKBqlW4iotm24Upx9a+qCltWZxZQEg/hjjQdruxxqXFlKUKMlKVSozlIG6j9n30OqQhtISnpEiFqKi5BEqUNye4UDGkmSkkFozKrr9pw25wkwkEp8stK7s6lBa5dKUzJglIM6ExrQdoc6S0LOWa1ctd3dUz7JBG/EUiZkZd1NBGOei0Q420cj4kZ+4J7tPdqm7Kw6cXXSTJJOp6uuhicqp7S5J1r039KDuJqysphIzy4YUgQRu09a84as8KVmMhUBzhJwQwu6wn9iwoKikqBCDEA6nLyzrq1vOr6JK9UjWcyFRE55RBrpLsBZOmAe4NS3q2gPpwg9ZDayT/ABAGPCgoGW963bUYG3BA5D3JUWpJxE5FQ+nrXQuGXG0lZ66MUJExlplyphtMhLbgwAAETkM84zJpZjKcGFw5pzj8PdNFpK55cTCgvK6C08hpRIBzziY4wNN9bF2pSUZnNR4V0p1S3UdYk5656UQHiUCImTB8aqfOha6bRunH64JhcuSlju+ZoG/19ZH976KuhfXVOsH3oLaX8NZSYuvrku4M9j+3+4rHozMwANJrTh6o10pG4qdTRza5AknTj8q2TmvOO0Ryz1j+UfOuX0JlB4nPyNFWWzyqT8Exx1oB+0QpsfPuNLpuDpHQIKNtUp0m1HiA7TnkBr3o2yNyqR8Kt3caF2hP+Wa5H/1qK67UQ4e2vIgAHKCDnFS7QfuzXI/KgqtIqt+uBXTs/wCXrzyH7gmlrV/l/Ae9V5u1RAGpIE08ezs/gP8AdVYTAgkwR3UFifMPb8Ft+0TfxmHm34o68m1JRPhkTl60nBJ1JNOLXeKXEYSY8BS4BsHtHyreI4rz8qJnWi2hXILfxelStOtg5q9KexzBqUDuxHoBUhYBzxg/+PfQj8pEFe7TKp0W9tK1KmQSCAdMhFLXcKiTiGZmlPILvrmibATKy25OECMMATOc+G6tKvYzklB74I+dAM4Qc1CKIQtsbxUDWqyVHetvLsEpSOyITImDrzqZl4pVkActCdaGvAJKerEyMhWwrPWNKFwGKFBMI5ds34EjkRUCXfvEqBAjjnWJcRvIJzzrVlU2JxEU5tNnFC57ke8UJnElwqOmaY8M66ue2sIbT0iVFUnOCRE91RXg62oNwpJIic6BCEiOsNeIoalFuKJUa8xMKzC9LOowABlHYIrp222UGCBO/qHXyqrqSMWXvvo205kGRoN9WLSmfSQuquJVh2nvg21cJV2WwEpCYTHaJJGpHLdSPZG0hFoDmgCFHXeAfnW7NdziXDkRll3J0rVnsKilZTllqTA1NZjkjGqhbYCXcU5yn1Joi2SopAntQPPdWrcwpsgnDEIzBkEydDvijrG2VIbMGASsRrrupUfiT0W8Pb5Hh/qB7gp9vLb0qmonqISjPWQnrHnM1X23SElO6OGfnT60Ntuj7wFGeRJ0PfNJrW4lOJLaEYYwyc1qOk+PpRkwdFhAkItS+okfFA+tOkPElgKAhuATEyCowD5UhsKcakpnsCVHKJyA18aYG0OYVArThyyCgSYnhzpdIEALZtGoH13EHl4AA+IW9pGnXXlu4TgJy0yAG4cKRWGxOuqKUDTMkwEpHFROlNbHai0rrugg6jMmDXVutjCmujQtSQV41Q2rrZQkHlTHtPo66LGI0Wrpu1CVOLVaGSUoPZxGCcp0rlphoNfvCDmcwlR+VL27Q2lK0pDkrw9bBGQk6VzZWgBAS4on4gEp8aVgdM4vcmtrNAwz4hMbmjGqDKYMGInPLKsvJCXCATATPDWuWj0YISQVntEdkcEp40HaGiIKpjM95gjWkhs1sZ7At7r4m0FpQzIzeeAzyHfEnnkuxdyCYBPpRqbnUAADpxIoJwAHIVE84JAGuW+tBDvRMLPbtY2d6CeUGB7ie9WRpvE8QCAcG8wDBNKn7iKokx4p+tMXO1IjFEeGdVlLucZ1ltZcPM6LvbWYxrhvRIl0QYjSfgnt2XaWV4hnkREpGojjS/aNBTZ0JMZTppuoVl0FURORqW987Mjx96a8O3jC48fgVgobncV920g4OJn0gm9iSFMpB0IphZdn7OoAlUE7p59/dSy7j92nlUqW5JnjWGjVDHEFenvLV1djcBgwOAOUdUWxs7Z1wQuJKgcxCcJjPrb91B225WkLKRnkM5NY60K0MhRVbgEQ3I9pSbXZpY+akObywjVQC62uB861+qmuB86ICq2TWffVPWK3+RW5/wBtvchTdDXA+dcm52uB86MKq5Cqrf1PWPep5BbfpjuQn6nZ4Krf6ka/ionFXQVV+UVOZ71R2da/pjuQRuRr+L0rF3M0d6vT6UYSa5NWK9T1igOzrSf4YQRuNrir/wAa0q4WeK/Sjc6yasXFX1iqOzbT9MJebgZ+Jfp9a4VcDe5a/Smc1yTUFxV9Yqvuuz/TCWHZ9v41elcf4fb+M+lNCa1iq/KavrFD912f6YRxfKUuEKzOkjuEChmcaGAEncAZKecmc4zoq3WEBpwpkqCjEDKD3GhLzbwNNrKjBAMHcd9dE1KjROq8sLW1e7DhLefJLnbCspMugkThEzmfQU7s13qCBhKQAIIUeA46etJm3wRKT/8AlP3ErSgZ9VQGW40tlZ8mVpr7MtWsaGE8c8RPJLLXYlKMFCEb5JP19qiTdKQCekRyGvnFSkmYNcrVAn3pTrh5dC1UthWgAe4EnqckNYbLmv7siSMAM5gDifOm9mu219AUoCMKs1AFAUfE5+tR2d0wlZkwI5Ace6un30qIIEHfnI8t1M8pIgrE/YtNzjhcRB4Rl0iUttNkebV10LSTBCVpISY1z0rQtS1Ep6FsCD1hAPhRSLU4Mg4SJnCTI8jlXblrScw2lKtCU6Hvg1HXZ4BG37O0T+YnPlHxCiZup0oBShRUSd+gERRaLkdw55eINRB5R1UT41Kg1m8qOi1UvstaMMuJd0Jy8CF21ZQ2dBPHX30oC+1ARO/GPamOCADIMzkNRGWdK76ZUsoSkSetkI/h41ds474Yls2hRo0dn1G0WhoyyAj0ggVKBTIVly/5rhlmQSFTGZy7xXP6ptHwxzUn60WiyLbZWVYZJSMlAmJk6eFdZ9Rkeac8vFeIl/NOltjpxl+A0gesIS2l5LmJBOFUaoXrhUO/caeT98n8ivcUqutOJm1t78AcH8i8/QmsNq7AMXKPevRbfB82PWf7mIGyISVZLOhyjuom8/3ZHNXuaFupsKXhnUH0BNE2/wDdkc1e5rVcOBqMA5/Nc3Z4O6uJ9T4tTS7D90nlU+KhLs/ZJ5VPHdXCcRiK+g0s2N7B7gtuKmtVsprMPKoQrC5rus6Pl512lv8AvKrglCajBxUcVgrZj4h5iucSfjHmKIUnHggNxSGrh3hYU1oCtl5HxJ86z7Q38Q9aIUX8kk3tIekO9bitKrX2lHE/0K+laVaU8Ff0miFF/JAb2j6w7wtqrk1yp/LJCz4fWuC+r/SX7fOoaLuKoXtI6HwPyUhrkmuekX/pHzTXClL/ANMf1Cq3RVi7adAf/LvkujXM1wel+FA/nNc/ef8Ab/qNTd9Qp5Rya7uKZWq2rbbU0pt1ZVvCfeDpU20jK1MIBR2UgHCn+GB404vKzhYiSOU/KlN7LJRhJMCOInnXSdl5wXjLd29IpPdA+arNkYUEkqJnSOAq8rbUWUkYVJjcRI8NaqjAEga5jLjnVq+wpUOosBWmFRI8jpSqby+S5dS7otohjKWQHj1PVUu8HHMYIUEgkgTG7Wa7btYVkFYgBnIiD8xUt8XQ6lUKbiZ6xII11TB4VwLMEIy13mpV3bWYYzQ2jbp9cvBIYCez2J7s2QULznICtWyzJzjKo9m7OotqKCOJE5xxE6iprc2RkddfA5gihe3JHTfNV2ec5pUpAFR4amcbOtLbVblA4UgZc/Gs4pueSAuo67p0GB1QmE0bNEI1pExeqiQMKZOQ196bh9SFBLiCg9+lAbWqBMJtPa9pUcGh8E88vHREp1NK7/cgIIO800KhNB2xjpChMak68qu1kVRKLa4myqdnxCrRtSjoo/M1IlMpBLmeIdTj31Zk3KgD8IoS32dpKVdZOIbt812XZmV8+JEQmCD96j8ivlS7Zn95wnRxLjf9STHrRjZ+9a/Kr5UPdbiEuIV+JKgfWudQGJrmjl8SvTbdjzT/AFO/axKroSQ8AdwUPQ0Rbf3ZHM+5o6+2OjfcCFBKgoxI3H/g0vtv7sj8x9zTnSXMqcyPj81zbH+HcD/jPvajLA2VNphwjLdFTfYz/rO+YHyri6j90nlRadawOqvbkDzXsaVrSc0OI1A4nko2LpKz+0dgakqgAUuvO32Rk4UdK8sZEhxQTNE7SXiUpFnbMSJWRrypPY7sy0rbb03EYnFef2neU6b93SaJHGTl9eCgcvpR7NmSOalq+dQKvx1OrLY5pJp2mzNjvrS7IhQ0rUGBcY3FQ6nwCXWTaaCMdnZUO4Qat12PMPIxtBPekgBSeYqi3ndeDrJ8vpWrgt6mXUqnqnJQ4g0mpRkSFstdoFjwKkFvYMu5egOJwnMCDwAyrs5VLAIg/wB8KYbNWcKtLQOYmTPAA1jYCSM16KrWZTYSQMugSkpJ3HyNcpQtRhOIngBJNX1693ftBabs8pxYZAjLedIqIWVs3iMB0QSqI7U92+Kf5ONAeMLnDazxMsjzS4Z8lTlXVaInoHIG/Cayx3O+8CW21KAME6QeGdXC7bZanLThKSGQVSVAjqiYzmkr1uV9sKGVFLanBIToTIk+lQ0GAA56wo2/uHEthshuKZkDoevGEKdlbUElRbAABJlSeFau3ZN54YyUtpOhWYJ8Kb3y6tduDKVqCCUggEgRqqle2VvUp8tgkJbgADISB3URo0mySNMlVK8u6uFmIAuGKY0HZOZPJJ74utyzLLbgE6gjQjcRSyKbXterr4R0sdQQDEEiN/Glc1meGz5q6VCpUwDeRi4xorm5bInImkN6XyUjNue41ZnGQd8UFaLsQrtQa6K8XqvPn9qIMhhANO7pv1u0CJCXN6TkfCdRRlq2as85pPtS165LKkzgPOf7iqIBCbTqOYZUtpaAVrOQoW1jKo7ReLKMsSsuOZ/5oG0X40REnyrG6g/FK9BS2pQNMNcYVjsVnLZSUyUwPE6+VNV3wc0qQlaNwWlKoHDuoe67YClKk9kjzEUcVWdzqrxNnQLSJjmN4pzHFohZalKnWdjjNJraUKJUlKUj4RPsd1Vxu0ICHQUkrJgK3Z6g1ebRsq8pJUw41aE/wGF/0mqbb21NNdCtpaHMcnECNJjuOtMpA4i4jgsl5O6awEuzJ7NNeKFsdsCEEBAKj2VcJ151PYXXHFJClExnxgVGmyuvKClDCIAmIEDSBvpzZbMGxA8TvNKr3DWNgap+zNlvrvD6ghgM58exSr1rlGTjfM/7a0s5isCQdQDHGsFJ+B4ceC9Rd0TWt30m5FwgSmFqdG4jzqrW1lRJPjTtJA3DyFdY62naDeRXAb9m38ag7v8AKHQfvG/yq+VDM2ZUaEHPceNTvH75vkv5UctdZ6dc0swNR8SundbPbdy0uIwuOnVrULebJdXiAOaUgzxAgnWll5MlFnCTri+Zp1ipXf37L+YVdOuXvY2IghZquyaVrb1qjXEktI4KS6z90nlTGzcTupfdI+6TRdrVhZUe73pDmy+Oq69KoGW4eeDQe4JK0nG4pZ3k+QozrKIQgST5DvNCNdVHOrBs7d9qDzC20w3IW4sgEKAPZz4D1NdxrQ0QOC+evqOe4udqcz2lJ3budS8lgsvKcXGE4SlBnSDBy76gtlmdYc6NxCm16gKIIPJQyNew7Q7VIbIxEIyPWPduFVYWpi80EKzKSQlU9ZJ3EHhVFCCVSlddPfVUtzBQsgVbHmylWeokHmDBpLfKOtNXwV9FcritXSMNq3lMHmMqt+xrU2ifhST7CqBsg59wR8K/cVcbnvk2YqUEBRUIzMRWFsNqQV6J+OtZAt1Ij2zCPtV5Wy0KDbRLScfbSCDh50ddjCWrQ+oKKsDQClH8S95PfkKUv7VPKTACUj+ESfWlbdvcSFBKzC+1xPOm7xoM6rJ5I8tcA0NERAznQz4K13feK7ZZ3UYsLons5ZbvpVY2ZZm1pnLCTM7iAdaBbeUg9VRSe4xlUJUJmczrrJ8d9A6pigngtdO1LBUazIO06ZQU3fvDBbS9qA5u4aU2tzNiW79pU+CDCigRJPvVTjKo1CpvCCZEyZVutgSCHEQMMiMx1RN+XgbQ6VxA0SOAFK8NTqTXGGlP84yVrZDGhrdBkr0o8UfWuS3vCanU7Nax7wJPCda2rykIJdn7sqR3nd+KY041ZM1HPLumoHADI/5qKoXl96XYaQv2QjdXr1ou9KtcqUWm4285j5GpiV4CdFVNmr86L7p3sfhV8Pce6rhiBEggg5gj5Uud2dbjTx3V1ZmUMiArL0pT24tFttrh1PJyLDhRKkEpUMwQSKItN9WpSQh1c5A5gEwe8il6bahRjEJ799SW18rIk6JCRyGlZXy1vJd60eyq5pEH64KOSdc66NRpqQisRXcaojqK6GprW8V2kZmihDIC5w1mGpSmthB7xVJgKDcblaVTpO7WYooiuF2ZwutBKVnFjyAOcCcqbpuN859EocwR703ducBAWIXNJjnYnAZ8T0CUkUvv5P3P8wqzi4XPxFCea0j2FB3/ALOOlk9HDipHVRiJ56RR0KLxUaY4rLtC+t3W1RgeJIIGuvclN0j7pNbv1UNJHEpoiw2RbTYQ4kpWNUnUTpQO06o6McZPlFExs146obl8bNJ5sHiI+KEAkCrnsptIHSpjAU9GYmclAH0NU2zmU00s18tWcYljDijrJTJKh8UV1JyXi0btRbQm0MptCR0YKji3HPKR3VJYWmftAcbASg64JwzOR7qJ6dh9AKzjSpQUAYyB1KZ3Vv7QhAU2zhMjtfCN5O6gmVEivpIxqI0KlnzVVcvo5gU9tzgUrLQew31Wb1elyOFHoFcJ/sb2XB3g1aAnKqbs1eiGcWMKMjKOPCibw21CTCWD3FSo9BWZ1MucSuxQvGU6LWTpKsykga0MXRJzyqk2rbB9egQnkJpc5fb6tXCOWVDuXnRPbtC3aJMk9g+ZXoz7gjWKCcvBCdVJHMjKvO3LU4rVajzJqEpJqeTni5B97MaIaye1ejrv+zJGbySe6T7UC/tawOyFq8IHrVHCK66M00UWrE6/qmYgKzPbYfC15n6UKdrHvgR60mTZzUv2JXCiDGJTrqsfSXv/AEZOcVnRRwnzrdZVpMrlZB4CowgcfGsrKipcrAEjXvoG0WZInImsrKkKwUods0GAMqrd6KSCU7+E1usodFMRIVdfVGk1uzX283lOIcFfWt1lQgHVSnVfTcC0wU1s206PxpI5ZimjN92dQydA54gayspD7OnqF2KG27nR0HtHyIUotjSiAHUkk8auNw3S243jLaVGSJU4pI0+FINbrKXQpN3kLXtG9qutcQMHENJHByZmxNIzIs6OYUr/AHKFDP37Y2h1rY2nuQlofImsrK6BaG6LzBqPf+YkpLb9tLslJU666USU4SvIkQYwxupe/wDpMsSf2dlWs/xf/SjW6yrICLDCXP8A6V3P+lZG08yPkKWWj9KFvV2S2jkCfc1usqpQADNJX9rbWtRUpwEnU4QN0A1Cba44EuOLKyFRnqN9brKCBrxTnVXlsEmOSb2VzTgcxRrRHAEHcYisrKJKKISw1hzxx8IUYrpdoATgQAlPAfM763WVcAKkttjwQkn++VVZbC1EmcznWVlCSrUzSXE7pru0WVbnWwRAisrKqUUBabulRyiikbPrO6srKqZVhEJ2bXwoljZZR1EVusoMRRYQEaxsek6r9KJOyaE9/furdZUCuFtq4gDkkEUd+rf4E+VZWUKkL//Z" alt="">
    </div>
    <div class="slide slide-3">
        <img src="https://sylhetmirror.com/files/uploads/2020/12/BRTC-bus-service.jpg" alt="">
    </div>
</div>
<div class="py-5"></div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="/search" method="GET" class="container bg-danger p-4">
                <div class="row">
                    <div class="col-12 pt-0">
                        <h3 class="pb-1 pt-0 text-white">Search Trips</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-3 py-1">
                        <select name="from" type="text" class="form-select border-3 rounded-0 shadow-none">
                            <option value="">From</option>
                            @foreach ($point as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-lg-3 py-1">
                        <select name="to" type="text" class="form-select border-3 rounded-0 shadow-none">
                            <option value="">To</option>
                            @foreach ($point as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-lg-4 py-1">
                        <input type="date" name="doj" class="form-control border-3 rounded-0 shadow-none">
                    </div>
                    <div class="col-12 col-lg-2 py-1">
                        <button class="btn rounded-0 btn-primary border-2 shadow-none">
                            Search Trips
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="py-5"></div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- Custom Javascript -->
    <script>
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel({
                items:1,
                loop:true,
                nav:true,
                dots:true,
                autoplay:true,
                autoplaySpeed:1000,
                smartSpeed:1500,
                autoplayHoverPause:true
            });
        });
    </script>
@endsection
