@extends('public.layouts.layout')
@section('title')
@section('title')Airposted - Shipping Simplified - About us @stop
@stop

@section('meta')
    <meta name="title" content="About us">
    <meta name="description" content="Airposted - About us">
    <meta name="keywords" content="Airposted, About us">
@stop

@section('main')

<section class="row about-us-page">
    <div class="col-sm-10 col-sm-offset-1">
        
        <h1>About</h1>
        
        <summary class="row">
            <p>
                <b>
                Airposted is a team of builders who are passionate about simplifying shipping, 
                making it fast, affordable, secure and hassle free!
                </b>
            </p>
        </summary>
        
        <article class="row">
            <div class="col-sm-7 no-padding">
                
                <h2 class="blue-text">Our Mission.</h2>
                
                <p>
                    There are two things that drive us. One is to enable travelers with an easy 
                    way to fund their passions and the other is to give buyers access to goods 
                    they once never had access to before.
                </p>
                
                <p>
                    We believe that enabling travelers to deliver items around the world not 
                    only funds their passions but connects the world we live in. And by giving 
                    buyers access to goods where they are cheapest or uniquely available, the 
                    world really is at everyones fingertips. Whether it’s Belgian chocolate 
                    coming straight from Belgium or an iPhone from where it’s available cheapest, 
                    we’re excited to give people a new way to shop around the world. We agree 
                    that products shouldn’t cost more in some places than others and people 
                    should have access to all kinds of goods, despite where they live.
                </p>
                
                
            </div>
            
            <div class="col-sm-5 no-padding">
                
                <h2 class="blue-text">Our Vision.</h2>
                
                <p>
                    For us, it’s simple. We’re here to change the way people ship, buy and obtain 
                    goods around the world. As we grow, we look forward to becoming leaders in 
                    both the domestic and international shipping industries.
                </p>
                
                <h2 class="blue-text push-up-20">
                    Let’s make the world smaller one delivery at a time. Shipping simplified.
                </h2>
                
            </div>
            
        </article>
        
        <article class="row team">
            
            <h2 class="blue-text push-down-30">Our Team</h2>
            
            <div class="row">
                
                <div class="col-sm-4 col-md-3 push-down-50">
                    <figure>
                        <img src="/public/img/team/3.Rayan-Rahman.jpg" alt="Rayan Rahman's profile">
                    </figure>
                    <figdetails>
                        <p>
                            <b>Rayan R. 
                                <a href="http://www.rayanrahman.com/" class="link" target="_blank">
                                    <img class="pull-right" width="15" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAFjElEQVR42qVXDWhVZRg+200rkP4gKLFcNg0XU2nV2t/d+RsEoRVx0yTIkoa63e383WE/dgmi1Nq96+6c7zsTLDRctiiapUzL1ozIypKknNWY6EymVPazUeFWPe+d93p3z5m7ywMf477f973P+/t87wRhsi8UClTriSrF4q5isV7V4mfUCD9bE+Gj9FeNuH+qltsP+fuS4TwhNbJbhGg0X7ioLxSdLmlOWDHdHtlku1TTWavorA0gZ2EEr7H4iGzyfQA+hXNNkO1QTLYfRq4rqW278n9hBhtenqua7Aso+bpas8tIdrsWmwPQvxSN3SdbrTKAR4MN7lzIjgGwhTy9a1W8QDadnfjdW2myElzLy9HLUEDR+TJcPARPnyle/cLVJK6o3zwThhxCOMmbaSlg2hMNZyl5HTSc8pQaWXMWqxb7COfDRdGO6ZPiVlnsHnjwq6yzRwXh37S1ksGa4ckbsCyQVJwBPLbvbAFQf2qfvkUr4lcpJv9WMlntBUGlcKIaOTuuGKwuUy7qzt1QcBx/C9MeZQPr9q0w+JRiOE2Z4Q02OfOR+z5Rt5cJgk/RiWuc63DxK+T07TI9VljR0HIjrcq65nmqyT+VDdZRXvfS7JScwkvAqd/B+tabVNP9ALLeqka2ICUvr7Nny4a9HnqPZhqe/lCtkZqxNvEs5O8fjxwV7S93R5LLRw+15Lhiq6hvnakkK9NplC1nceZSDL4OoTrjkZvsSfI4Wy4b/Dmk5eNsOeUZET1RpSfuTFcxDkehfH9pOHFFdiRQUKtQOO965Fk5TufaaitFaoaJA8Z3S0cA8k7UwOtJr0UtXgBLPkNRrfUrOBDHTiquXIHR43MQveNBzZnvuaPb94PpjlRpbdcLouWuxMETpeENs3yaOgCjhiXLLs0VmCpXsdxu9PRSHz/y4PWARMSCfDjg3MN+3patjF0D4J+RhgW5A8NrUKdssVd8I6g7XZLOHxQo7sTDfofENbFCKgiiz6kAyxbfCr0f+tEl2jIOvKfJ493EOErEfc2zLHcHovE72uYtn7091E5+9yD/HgYP+u5F+EHgxQVYvQs5/hHtsdtnfYKeHEab9WTv4fLnBAyALs8e8giAX/x0gu9/wJ04Qs2247nr9AtZpdE8jypUDidunlKoTQbe5t1+oQb4RhXtS4depJfI98EIJ66Fgp+CemvxVIARiXdAn+3+RjmdyPPD9OosgVcn6SXxnCqpnQbgIYT6jilVtcn2VidfN789fpRIRgBbzYLygyCJen8L+T6lqU3KFZgeBjjSB2Ja5BkuNC7TS4UevyHZ1JLOWnC4W1zx6mUeCtQdXTKdLTkzF6KDwhoqC8Uu96Qgwtrh5HtEn+kxR4nwAdFkj8imG8xcksGb6J3NlsuWrSUfiSy5ajgWvPrSc95gIaRgAJSqjvfM5Bson1D2W+YiWfL5y5LXTCBPTp1YPnr+QO+/mfY2zVIaL6DGR6i6UXkPkYWphTTsRd8eRkqWp2Tg22eTHmecw9pEg59k2I+lZDQwYHbbDh2nK+sTC/3qKE80Wh9AXw9W4xXJ3KDJEWE6LRnuwolyXBhOXEosiPbkmXO1BLCxKdRt9Hg7nkudx2HdkKgl1EwCkDRWC6UdEwHjXjmFtHj52FRKX1HykXH7McM9P+mUmbTcYAZWn2zaphh1ZqRmMiIaSkM2MN2BUXtogjnfhlRUmMsNth53Z+Q6z+dXaryC6BLhOyBr9m3nmKwI4CcVM1F0Hjiaj9doG84eoAmGQGgURoEdCzayJRcM70SfGMHkSZRq8W9A/F1QuBrt0g7w7xDapyAbwYrRcCfCM+RxI872oBA3VdD/UBf3/1MoQGyk6va9YLGtiuEeQd5GQBJ/n3udRmHIICp4G1V9OR4UMRq9ZDK1/wFnccXMAsktBAAAAABJRU5ErkJggg==" alt="web"></img>
                                </a>
                                <a href="https://www.linkedin.com/in/rayanr" class="link" target="_blank">
                                    <img class="pull-right" width="15" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAACmklEQVR42mOYc/jaP8mSRf8Y0mfSHLNmzv5n07X+35n7L/8xaNat/MeQNuM/UII+GGhX9Jzd/xlEixb+o5ulUGzSumYwWQwMCuaMmf8lShb+Fy1eSD+L+fPn/Z9z6Or/a8/e/r/85M3/xs2n/rNlzaa9xbFzd///+/fvfxj49P3nf/O2dbS3uG3r6f///v2DWwxi+0/bQXuLXfs2AX35A27po7ef/mvUraC9xWyZs/57TNj8f/r+y/+7d57/b9q69j9TBp1SNQJPR7Ax5DAxOzARcubM+c+IrIdYi1Vrlv7v2nEOjhs2nvwvUQrJVpbt61Dkuraf+8+fN/e/QsXi/xP3XPh/+Paz/8fvPv+/9tyd/75TtoGzJdEWu/Vv/o8M3nz+/l+3cRVYLmXRARQ5UBoImbHz/2NgOvj37y9Kovzx+/f/9m2nwVGH7nscFm/BaXEyFoufvv8MthQdgOR+//7zv2jlEUiUUWJx0oIDGBb8/fvv/91X7/+fuPf8/+2X78EWIvv84qPX/4UK5lHo44WYFh+59eS/SvXS/9y5c//Lli/+v+PKAxSLX3/+9l+nYSV1gxoEnHo3osShOzAr/v7zBy7//dfv/xbt66hvsVzFEhSLDZtW///w7Qdc/vefv/+tO9dT32JQ8CJbrN+8+v/7r0gWA8t9m64NQ9Ti1MUDZHHa4oMjzOKMJTS02K5zw/+Hbz7B8QVgyaMOrY9j5+5FkQNhSVAFgmSxVv3K/5cev4HL3331AVy1ErSYM3v2f6WqZXAsD8ynbFmzwHJ8wJoIWQ6EwTUQksWg9hlID0xesXLpfw60NtvANm+h3Rf6W+w1aSt9LQZGSxqwIGI4//D1v/CZu/4Dff5fnMZYunTR/9g5e4ANyM//Aa8UwmomUhYCAAAAAElFTkSuQmCC" alt="linkedin">
                                </a>
                            </b><br>Co-founder, CEO
                        </p>
                    </figdetails>
                </div>
                
                <div class="col-sm-4 col-md-3 push-down-50">
                    <figure>
                        <img src="/public/img/team/1.raisa-rahman.jpg" alt="Raisa Rahman's profile">
                    </figure>
                    <figdetails>
                        <p>
                            <b>Raisa Rahman
                            <a href="https://www.linkedin.com/in/raisarahman" class="link" target="_blank">
                                <img class="pull-right" width="15" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAACmklEQVR42mOYc/jaP8mSRf8Y0mfSHLNmzv5n07X+35n7L/8xaNat/MeQNuM/UII+GGhX9Jzd/xlEixb+o5ulUGzSumYwWQwMCuaMmf8lShb+Fy1eSD+L+fPn/Z9z6Or/a8/e/r/85M3/xs2n/rNlzaa9xbFzd///+/fvfxj49P3nf/O2dbS3uG3r6f///v2DWwxi+0/bQXuLXfs2AX35A27po7ef/mvUraC9xWyZs/57TNj8f/r+y/+7d57/b9q69j9TBp1SNQJPR7Ax5DAxOzARcubM+c+IrIdYi1Vrlv7v2nEOjhs2nvwvUQrJVpbt61Dkuraf+8+fN/e/QsXi/xP3XPh/+Paz/8fvPv+/9tyd/75TtoGzJdEWu/Vv/o8M3nz+/l+3cRVYLmXRARQ5UBoImbHz/2NgOvj37y9Kovzx+/f/9m2nwVGH7nscFm/BaXEyFoufvv8MthQdgOR+//7zv2jlEUiUUWJx0oIDGBb8/fvv/91X7/+fuPf8/+2X78EWIvv84qPX/4UK5lHo44WYFh+59eS/SvXS/9y5c//Lli/+v+PKAxSLX3/+9l+nYSV1gxoEnHo3osShOzAr/v7zBy7//dfv/xbt66hvsVzFEhSLDZtW///w7Qdc/vefv/+tO9dT32JQ8CJbrN+8+v/7r0gWA8t9m64NQ9Ti1MUDZHHa4oMjzOKMJTS02K5zw/+Hbz7B8QVgyaMOrY9j5+5FkQNhSVAFgmSxVv3K/5cev4HL3331AVy1ErSYM3v2f6WqZXAsD8ynbFmzwHJ8wJoIWQ6EwTUQksWg9hlID0xesXLpfw60NtvANm+h3Rf6W+w1aSt9LQZGSxqwIGI4//D1v/CZu/4Dff5fnMZYunTR/9g5e4ANyM//Aa8UwmomUhYCAAAAAElFTkSuQmCC" alt="linkedin">
                            </a>
                            </b><br>CPO
                        </p>
                    </figdetails>
                </div>
                
                <div class="col-sm-4 col-md-3 push-down-50">
                    <figure>
                        <img src="/public/img/team/3.mithun.jpg" alt="Mithun Molla's profile">
                    </figure>
                    <figdetails>
                        <p>
                            <b>Mithun Molla
                            <a href="https://bd.linkedin.com/in/mmithun" class="link" target="_blank">
                                <img class="pull-right" width="15" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAACmklEQVR42mOYc/jaP8mSRf8Y0mfSHLNmzv5n07X+35n7L/8xaNat/MeQNuM/UII+GGhX9Jzd/xlEixb+o5ulUGzSumYwWQwMCuaMmf8lShb+Fy1eSD+L+fPn/Z9z6Or/a8/e/r/85M3/xs2n/rNlzaa9xbFzd///+/fvfxj49P3nf/O2dbS3uG3r6f///v2DWwxi+0/bQXuLXfs2AX35A27po7ef/mvUraC9xWyZs/57TNj8f/r+y/+7d57/b9q69j9TBp1SNQJPR7Ax5DAxOzARcubM+c+IrIdYi1Vrlv7v2nEOjhs2nvwvUQrJVpbt61Dkuraf+8+fN/e/QsXi/xP3XPh/+Paz/8fvPv+/9tyd/75TtoGzJdEWu/Vv/o8M3nz+/l+3cRVYLmXRARQ5UBoImbHz/2NgOvj37y9Kovzx+/f/9m2nwVGH7nscFm/BaXEyFoufvv8MthQdgOR+//7zv2jlEUiUUWJx0oIDGBb8/fvv/91X7/+fuPf8/+2X78EWIvv84qPX/4UK5lHo44WYFh+59eS/SvXS/9y5c//Lli/+v+PKAxSLX3/+9l+nYSV1gxoEnHo3osShOzAr/v7zBy7//dfv/xbt66hvsVzFEhSLDZtW///w7Qdc/vefv/+tO9dT32JQ8CJbrN+8+v/7r0gWA8t9m64NQ9Ti1MUDZHHa4oMjzOKMJTS02K5zw/+Hbz7B8QVgyaMOrY9j5+5FkQNhSVAFgmSxVv3K/5cev4HL3331AVy1ErSYM3v2f6WqZXAsD8ynbFmzwHJ8wJoIWQ6EwTUQksWg9hlID0xesXLpfw60NtvANm+h3Rf6W+w1aSt9LQZGSxqwIGI4//D1v/CZu/4Dff5fnMZYunTR/9g5e4ANyM//Aa8UwmomUhYCAAAAAElFTkSuQmCC" alt="linkedin">
                            </a>
                            </b><br>Co-founder, CTO
                        </p>
                    </figdetails>
                </div>
                
                <div class="col-sm-4 col-md-3 push-down-50">
                    <figure>
                        <img src="/public/img/team/11.shakil-ahmed.jpg" alt="Shakil Ahmed's profile">
                    </figure>
                    <figdetails>
                        <p>
                            <b>Shakil Ahmed
                            </b><br>Chief Investment Officer
                        </p>
                    </figdetails>
                </div>
            
            </div>
            
            <div class="row">
                
                <div class="col-sm-4 col-md-3 push-down-50">
                    <figure>
                        <img src="/public/img/team/6.ashiqul-islam.jpg" alt="ashiqul islam's profile">
                    </figure>
                    <figdetails>
                        <p>
                            <b>Md Ashiqul Islam
                            <a href="https://www.linkedin.com/in/ashique19/" class="link" target="_blank">
                                <img class="pull-right" width="15" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAACmklEQVR42mOYc/jaP8mSRf8Y0mfSHLNmzv5n07X+35n7L/8xaNat/MeQNuM/UII+GGhX9Jzd/xlEixb+o5ulUGzSumYwWQwMCuaMmf8lShb+Fy1eSD+L+fPn/Z9z6Or/a8/e/r/85M3/xs2n/rNlzaa9xbFzd///+/fvfxj49P3nf/O2dbS3uG3r6f///v2DWwxi+0/bQXuLXfs2AX35A27po7ef/mvUraC9xWyZs/57TNj8f/r+y/+7d57/b9q69j9TBp1SNQJPR7Ax5DAxOzARcubM+c+IrIdYi1Vrlv7v2nEOjhs2nvwvUQrJVpbt61Dkuraf+8+fN/e/QsXi/xP3XPh/+Paz/8fvPv+/9tyd/75TtoGzJdEWu/Vv/o8M3nz+/l+3cRVYLmXRARQ5UBoImbHz/2NgOvj37y9Kovzx+/f/9m2nwVGH7nscFm/BaXEyFoufvv8MthQdgOR+//7zv2jlEUiUUWJx0oIDGBb8/fvv/91X7/+fuPf8/+2X78EWIvv84qPX/4UK5lHo44WYFh+59eS/SvXS/9y5c//Lli/+v+PKAxSLX3/+9l+nYSV1gxoEnHo3osShOzAr/v7zBy7//dfv/xbt66hvsVzFEhSLDZtW///w7Qdc/vefv/+tO9dT32JQ8CJbrN+8+v/7r0gWA8t9m64NQ9Ti1MUDZHHa4oMjzOKMJTS02K5zw/+Hbz7B8QVgyaMOrY9j5+5FkQNhSVAFgmSxVv3K/5cev4HL3331AVy1ErSYM3v2f6WqZXAsD8ynbFmzwHJ8wJoIWQ6EwTUQksWg9hlID0xesXLpfw60NtvANm+h3Rf6W+w1aSt9LQZGSxqwIGI4//D1v/CZu/4Dff5fnMZYunTR/9g5e4ANyM//Aa8UwmomUhYCAAAAAElFTkSuQmCC" alt="linkedin">
                            </a>
                            </b><br>Ninja Coder
                        </p>
                    </figdetails>
                </div>
                
                <div class="col-sm-4 col-md-3 push-down-50">
                    <figure>
                        <img src="/public/img/team/9.rachel-visser.jpg" alt="Rachel Visser's profile">
                    </figure>
                    <figdetails>
                        <p>
                            <b>Rachel Visser
                            <a href="https://www.linkedin.com/in/rachellvisser/" class="link" target="_blank">
                                <img class="pull-right" width="15" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAACmklEQVR42mOYc/jaP8mSRf8Y0mfSHLNmzv5n07X+35n7L/8xaNat/MeQNuM/UII+GGhX9Jzd/xlEixb+o5ulUGzSumYwWQwMCuaMmf8lShb+Fy1eSD+L+fPn/Z9z6Or/a8/e/r/85M3/xs2n/rNlzaa9xbFzd///+/fvfxj49P3nf/O2dbS3uG3r6f///v2DWwxi+0/bQXuLXfs2AX35A27po7ef/mvUraC9xWyZs/57TNj8f/r+y/+7d57/b9q69j9TBp1SNQJPR7Ax5DAxOzARcubM+c+IrIdYi1Vrlv7v2nEOjhs2nvwvUQrJVpbt61Dkuraf+8+fN/e/QsXi/xP3XPh/+Paz/8fvPv+/9tyd/75TtoGzJdEWu/Vv/o8M3nz+/l+3cRVYLmXRARQ5UBoImbHz/2NgOvj37y9Kovzx+/f/9m2nwVGH7nscFm/BaXEyFoufvv8MthQdgOR+//7zv2jlEUiUUWJx0oIDGBb8/fvv/91X7/+fuPf8/+2X78EWIvv84qPX/4UK5lHo44WYFh+59eS/SvXS/9y5c//Lli/+v+PKAxSLX3/+9l+nYSV1gxoEnHo3osShOzAr/v7zBy7//dfv/xbt66hvsVzFEhSLDZtW///w7Qdc/vefv/+tO9dT32JQ8CJbrN+8+v/7r0gWA8t9m64NQ9Ti1MUDZHHa4oMjzOKMJTS02K5zw/+Hbz7B8QVgyaMOrY9j5+5FkQNhSVAFgmSxVv3K/5cev4HL3331AVy1ErSYM3v2f6WqZXAsD8ynbFmzwHJ8wJoIWQ6EwTUQksWg9hlID0xesXLpfw60NtvANm+h3Rf6W+w1aSt9LQZGSxqwIGI4//D1v/CZu/4Dff5fnMZYunTR/9g5e4ANyM//Aa8UwmomUhYCAAAAAElFTkSuQmCC" alt="linkedin">
                            </a>
                            </b><br>Graphic Designer
                        </p>
                    </figdetails>
                </div>
                
                <div class="col-sm-4 col-md-3 push-down-50">
                    <figure>
                        <img src="/public/img/team/10.Sandra-Maiden.jpg" alt="Sandra Maiden's profile">
                    </figure>
                    <figdetails>
                        <p>
                            <b>Sandra Maiden
                            </b><br>Graphic Designer
                        </p>
                    </figdetails>
                </div>
                
                <div class="col-sm-4 col-md-3 push-down-50">
                    <figure>
                        <img src="/public/img/team/8.swetha-suresh.jpg" alt="Swetha Suresh's profile">
                    </figure>
                    <figdetails>
                        <p>
                            <b>Swetha Suresh
                            <a href="https://www.linkedin.com/in/swetha-thuravupala-a5a73159/" class="link" target="_blank">
                                <img class="pull-right" width="15" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAACmklEQVR42mOYc/jaP8mSRf8Y0mfSHLNmzv5n07X+35n7L/8xaNat/MeQNuM/UII+GGhX9Jzd/xlEixb+o5ulUGzSumYwWQwMCuaMmf8lShb+Fy1eSD+L+fPn/Z9z6Or/a8/e/r/85M3/xs2n/rNlzaa9xbFzd///+/fvfxj49P3nf/O2dbS3uG3r6f///v2DWwxi+0/bQXuLXfs2AX35A27po7ef/mvUraC9xWyZs/57TNj8f/r+y/+7d57/b9q69j9TBp1SNQJPR7Ax5DAxOzARcubM+c+IrIdYi1Vrlv7v2nEOjhs2nvwvUQrJVpbt61Dkuraf+8+fN/e/QsXi/xP3XPh/+Paz/8fvPv+/9tyd/75TtoGzJdEWu/Vv/o8M3nz+/l+3cRVYLmXRARQ5UBoImbHz/2NgOvj37y9Kovzx+/f/9m2nwVGH7nscFm/BaXEyFoufvv8MthQdgOR+//7zv2jlEUiUUWJx0oIDGBb8/fvv/91X7/+fuPf8/+2X78EWIvv84qPX/4UK5lHo44WYFh+59eS/SvXS/9y5c//Lli/+v+PKAxSLX3/+9l+nYSV1gxoEnHo3osShOzAr/v7zBy7//dfv/xbt66hvsVzFEhSLDZtW///w7Qdc/vefv/+tO9dT32JQ8CJbrN+8+v/7r0gWA8t9m64NQ9Ti1MUDZHHa4oMjzOKMJTS02K5zw/+Hbz7B8QVgyaMOrY9j5+5FkQNhSVAFgmSxVv3K/5cev4HL3331AVy1ErSYM3v2f6WqZXAsD8ynbFmzwHJ8wJoIWQ6EwTUQksWg9hlID0xesXLpfw60NtvANm+h3Rf6W+w1aSt9LQZGSxqwIGI4//D1v/CZu/4Dff5fnMZYunTR/9g5e4ANyM//Aa8UwmomUhYCAAAAAElFTkSuQmCC" alt="linkedin">
                            </a>
                            </b><br>Graphic designer
                        </p>
                    </figdetails>
                </div>
                
            </div>
            
            <div class="row">
                
                <div class="col-sm-4 col-md-3 push-down-50">
                    <figure>
                        <img src="/public/img/team/7.kyle-lynch.jpg" alt="Kyle Lynch's profile">
                    </figure>
                    <figdetails>
                        <p>
                            <b>Kyle Lynch
                            </b><br>Social Media Strategist
                        </p>
                    </figdetails>
                </div>
                
                <div class="col-sm-4 col-md-3 push-down-50">
                    <figure>
                        <img src="/public/img/team/5.matias-arnal.jpg" alt="Matial arnal's profile">
                    </figure>
                    <figdetails>
                        <p>
                            <b>Matias Arnal
                            <a href="https://www.linkedin.com/in/matias-arnal-5749b111/" class="link" target="_blank">
                                <img class="pull-right" width="15" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAACmklEQVR42mOYc/jaP8mSRf8Y0mfSHLNmzv5n07X+35n7L/8xaNat/MeQNuM/UII+GGhX9Jzd/xlEixb+o5ulUGzSumYwWQwMCuaMmf8lShb+Fy1eSD+L+fPn/Z9z6Or/a8/e/r/85M3/xs2n/rNlzaa9xbFzd///+/fvfxj49P3nf/O2dbS3uG3r6f///v2DWwxi+0/bQXuLXfs2AX35A27po7ef/mvUraC9xWyZs/57TNj8f/r+y/+7d57/b9q69j9TBp1SNQJPR7Ax5DAxOzARcubM+c+IrIdYi1Vrlv7v2nEOjhs2nvwvUQrJVpbt61Dkuraf+8+fN/e/QsXi/xP3XPh/+Paz/8fvPv+/9tyd/75TtoGzJdEWu/Vv/o8M3nz+/l+3cRVYLmXRARQ5UBoImbHz/2NgOvj37y9Kovzx+/f/9m2nwVGH7nscFm/BaXEyFoufvv8MthQdgOR+//7zv2jlEUiUUWJx0oIDGBb8/fvv/91X7/+fuPf8/+2X78EWIvv84qPX/4UK5lHo44WYFh+59eS/SvXS/9y5c//Lli/+v+PKAxSLX3/+9l+nYSV1gxoEnHo3osShOzAr/v7zBy7//dfv/xbt66hvsVzFEhSLDZtW///w7Qdc/vefv/+tO9dT32JQ8CJbrN+8+v/7r0gWA8t9m64NQ9Ti1MUDZHHa4oMjzOKMJTS02K5zw/+Hbz7B8QVgyaMOrY9j5+5FkQNhSVAFgmSxVv3K/5cev4HL3331AVy1ErSYM3v2f6WqZXAsD8ynbFmzwHJ8wJoIWQ6EwTUQksWg9hlID0xesXLpfw60NtvANm+h3Rf6W+w1aSt9LQZGSxqwIGI4//D1v/CZu/4Dff5fnMZYunTR/9g5e4ANyM//Aa8UwmomUhYCAAAAAElFTkSuQmCC" alt="linkedin">
                            </a>
                            </b><br>Advisor
                        </p>
                    </figdetails>
                </div>
                
            </div>
            
        </article>
        
    </div>
</section>

@stop
        