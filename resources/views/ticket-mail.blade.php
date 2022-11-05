<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" dir="rtl">
<html>
  <head>
    <title>Ticket</title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <style>
      .ticket {
        display: flex;
        font-family: Roboto;
        margin: 16px;
        border: 1px solid #e0e0e0;
        position: relative;
      }
      .ticket:before {
        content: '';
        width: 32px;
        height: 32px;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-top-color: transparent;
        border-left-color: transparent;
        position: absolute;
        transform: rotate(-45deg);
        left: -18px;
        top: 50%;
        margin-top: -16px;
        border-radius: 50%;
      }
      .ticket:after {
        content: '';
        width: 32px;
        height: 32px;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-top-color: transparent;
        border-left-color: transparent;
        position: absolute;
        transform: rotate(135deg);
        right: -18px;
        top: 50%;
        margin-top: -16px;
        border-radius: 50%;
      }
      .ticket--start {
        position: relative;
        border-right: 1px dashed #e0e0e0;
      }
      .ticket--start:before {
        content: '';
        width: 32px;
        height: 32px;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-top-color: transparent;
        border-left-color: transparent;
        border-right-color: transparent;
        position: absolute;
        transform: rotate(-45deg);
        left: -18px;
        top: -2px;
        margin-top: -16px;
        border-radius: 50%;
      }
      .ticket--start:after {
        content: '';
        width: 32px;
        height: 32px;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-top-color: transparent;
        border-left-color: transparent;
        border-bottom-color: transparent;
        position: absolute;
        transform: rotate(-45deg);
        left: -18px;
        top: 100%;
        margin-top: -16px;
        border-radius: 50%;
      }
      .ticket--start > img {
        display: block;
        padding: 24px;
        height: 270px;
      }
      .ticket--center {
        padding: 24px;
        flex: 1;
      }
      .ticket--center--row {
        display: flex;
      }
      .ticket--center--row:not(:last-child) {
        padding-bottom: 48px;
      }
      .ticket--center--row:first-child span {
        color: #4872b0;
        text-transform: uppercase;
        line-height: 24px;
        font-size: 13px;
        font-weight: 500;
      }
      .ticket--center--row:first-child strong {
        font-size: 20px;
        font-weight: 400;
        text-transform: uppercase;
      }
      .ticket--center--col {
        display: flex;
        flex: 1;
        width: 50%;
        box-sizing: border-box;
        flex-direction: column;
      }
      .ticket--center--col:not(:last-child) {
        padding-right: 16px;
      }
      .ticket--end {
        padding: 24px;
        background-color: #4872b0;
        display: flex;
        flex-direction: column;
        position: relative;
      }
      .ticket--end:before {
        content: '';
        width: 32px;
        height: 32px;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-top-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        position: absolute;
        transform: rotate(-45deg);
        right: -18px;
        top: -2px;
        margin-top: -16px;
        border-radius: 50%;
      }
      .ticket--end:after {
        content: '';
        width: 32px;
        height: 32px;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-right-color: transparent;
        border-left-color: transparent;
        border-bottom-color: transparent;
        position: absolute;
        transform: rotate(-45deg);
        right: -18px;
        top: 100%;
        margin-top: -16px;
        border-radius: 50%;
      }
      .ticket--end > div:first-child {
        flex: 1;
      }
      .ticket--end > div:first-child > img {
        width: 128px;
        padding: 4px;
        background-color: #fff;
      }
      .ticket--end > div:last-child > img {
        display: block;
        margin: 0 auto;
        filter: brightness(0) invert(1);
        opacity: 0.64;
      }
      .ticket--info--title {
        text-transform: uppercase;
        color: #757575;
        font-size: 13px;
        line-height: 24px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      .ticket--info--subtitle {
        font-size: 16px;
        line-height: 24px;
        font-weight: 500;
        color: #4872b0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      .ticket--info--content {
        font-size: 13px;
        line-height: 24px;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
    </style>
  </head>
  <body>
    <div class="ticket">
      <div class="ticket--center">
        <div class="ticket--center--row">
          <div class="ticket--center--col">
            <span>تذكرة لعرض</span>
            <strong>اغلي الحاجات من غير فلوس</strong>
          </div>
          <div class="ticket--center--col">
            <span class="ticket--info--title">رقم الحجز</span>
            <span class="ticket--info--content"> {{ $id}}</span>
          </div>
        </div>
        <div class="ticket--center--row">
          <div class="ticket--center--col">
            <span class="ticket--info--title">الميعاد</span>
            <span class="ticket--info--subtitle"> @if ($event['id'] == 1)
                الخميس 10 نوفمبر 2022
            @else
            الجمعة 10 نوفمبر 2022

            @endif </span>
            <span class="ticket--info--content">{{ (int) $event_date['time']}}:00 مساءً</span>
          </div>
          <div class="ticket--center--col">
            <span class="ticket--info--title">العنوان</span>
            <span class="ticket--info--subtitle"
              >الكاتدرائية المرقسية بالعباسية (مسرح الانبا رويس)</span
            >
            <span class="ticket--info--content">العباسية، القاهرة</span>
          </div>
        </div>
        <div class="ticket--center--row">
          <div class="ticket--center--col">
            <span class="ticket--info--title">نوع الحجز</span>
            <span class="ticket--info--content">{{ @$type == 0 ? "افراد" : "مجموعة"}}</span>
          </div>
          <div class="ticket--center--col">
            <span class="ticket--info--title">رقم التذكرة</span>
            <span class="ticket--info--content"> {{@$ticket['seat_number']}}</span>
          </div>
        </div>
      </div>
      <div class="ticket--end">
        <div>
            {!! QrCode::size(300)->generate(route('pa' , 10)) !!}

        </div>
      </div>
    </div>
  </body>
</html>
