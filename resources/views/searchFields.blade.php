<section class="search-filter">
    <button class="closeSearchFilter"><i class="fas fa-times"></i></button>
    <div class="search-filter-inner">
        <h1>تنظیمات نمایش</h1>
        <div class="form-group-container">
            <form id="searchfilter-form" action="" method="GET" role="search">
                <!-- ------------- -->

                <!-- genre type -->
                <div class="form-group-title SearchBoxTitle">
                    <a id="janr" class="searchbox-btn" href="javascript:void(0)">ژانر</a>
                </div>
                <div class="form-group-control min-searchfilter minSB">
                    @foreach ($genres as $genre)
                        <div class="cr-container">
                            <label class="custom-radio">
                                <input type="checkbox" class="checkboxStyle" id="cat-dream" name="cat-j[]" value="{{ $genre->title }}" />
                                {{ $genre->title }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <!-- genre type end -->
                <!-- -------------- -->
                <!-- -------------- -->

                <!-- news film -->
                <div class="form-group-title SearchBoxTitle">
                    <a id="news-btn" class="searchbox-btn" href="javascript:void(0)">جدیدترین
                        ها</a>
                </div>
                <div class="form-group-control normal-search-filter">
                    <div class="cr-container">
                        <label class="custom-radio">
                            جدید ترین ها
                            <input type="radio" id="cat-news" name="cat-n" value="جدیدترین">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            قدیمی ترین ها
                            <input type="radio" id="cat-olds" name="cat-n" value="قدیمی">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            امتیاز
                            <input type="radio" id="cat-for-score" name="cat-n"
                                value="بر اساس امتیاز">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                </div>
                <!-- news film end -->
                <!-- ------------- -->
                <!-- ------------- -->

                <!-- dubbed film -->
                <div class="form-group-title SearchBoxTitle">
                    <a id="dubbed-btn" class="searchbox-btn" href="javascript:void(0)">دوبله و
                        زیرنویس</a>
                </div>
                <div class="form-group-control normal-search-filter">
                    <div class="cr-container">
                        <label class="custom-radio">
                            دوبله شده
                            <input type="radio" id="cat-dubbed" name="cat-ds" value="دوبله شده">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            زیرنویس
                            <input type="radio" id="cat-subtitle" name="cat-ds" value="زیرنویس">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                </div>
                <!-- dubbed film end -->
                <!-- --------------- -->
                <!-- --------------- -->

                <!-- year filter starts -->
                <div class="Ofyear-Unyear">
                    <div class="of-year">
                        <div class="form-group-title SearchBoxTitle">
                            <a id="ofyear-btn" class="searchbox-btn"
                                href="javascript:void(0)">از
                                سال</a>
                        </div>
                        <div class="form-group-control min-searchfilter minSB">
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۱۹۹۹
                                    <input type="radio" id="cat-of1999" name="cat-ofyear"
                                        value="۱۹۹۹">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۰
                                    <input type="radio" id="cat-of2000" name="cat-ofyear"
                                        value="۲۰۰۰">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۱
                                    <input type="radio" id="cat-of2001" name="cat-ofyear"
                                        value="۲۰۰۱">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۲
                                    <input type="radio" id="cat-of2002" name="cat-ofyear"
                                        value="۲۰۰۲">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>

                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۳
                                    <input type="radio" id="cat-of2003" name="cat-ofyear"
                                        value="۲۰۰۳">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۴
                                    <input type="radio" id="cat-of2004" name="cat-ofyear"
                                        value="۲۰۰۴">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۵
                                    <input type="radio" id="cat-of2005" name="cat-ofyear"
                                        value="۲۰۰۵">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۶
                                    <input type="radio" id="cat-of2006" name="cat-ofyear"
                                        value="۲۰۰۶">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۷
                                    <input type="radio" id="cat-of2007" name="cat-ofyear"
                                        value="۲۰۰۷">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۸
                                    <input type="radio" id="cat-of2008" name="cat-ofyear"
                                        value="۲۰۰۸">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۹
                                    <input type="radio" id="cat-of2009" name="cat-ofyear"
                                        value="۲۰۰۹">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۰
                                    <input type="radio" id="cat-of2010" name="cat-ofyear"
                                        value="۲۰۱۰">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۱
                                    <input type="radio" id="cat-of2011" name="cat-ofyear"
                                        value="۲۰۱۱">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۲
                                    <input type="radio" id="cat-of2012" name="cat-ofyear"
                                        value="۲۰۱۲">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۳
                                    <input type="radio" id="cat-of2013" name="cat-ofyear"
                                        value="۲۰۱۳">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۴
                                    <input type="radio" id="cat-of2014" name="cat-ofyear"
                                        value="۲۰۱۴">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>

                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۵
                                    <input type="radio" id="cat-of2015" name="cat-ofyear"
                                        value="۲۰۱۵">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۶
                                    <input type="radio" id="cat-of2016" name="cat-ofyear"
                                        value="۲۰۱۶">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۷
                                    <input type="radio" id="cat-of2017" name="cat-ofyear"
                                        value="۲۰۱۷">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۸
                                    <input type="radio" id="cat-of2018" name="cat-ofyear"
                                        value="۲۰۱۸">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۹
                                    <input type="radio" id="cat-of2019" name="cat-ofyear"
                                        value="۲۰۱۹">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۲۰
                                    <input type="radio" id="cat-of2020" name="cat-ofyear"
                                        value="۲۰۲۰">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۲۱
                                    <input type="radio" id="cat-of2021" name="cat-ofyear"
                                        value="۲۰۲۱">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- ------------------ -->
                    <!-- ------------------ -->

                    <!-- year filter --->
                    <div class="un-year">
                        <div class="form-group-title SearchBoxTitle">
                            <a id="unyear-btn" class="searchbox-btn"
                                href="javascript:void(0)">تا
                                سال</a>
                        </div>
                        <div class="form-group-control min-searchfilter minSB">
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۱۹۹۹
                                    <input type="radio" id="cat-1999" name="cat-unyear"
                                        value="۱۹۹۹">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۰
                                    <input type="radio" id="cat-2000" name="cat-unyear"
                                        value="۲۰۰۰">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۱
                                    <input type="radio" id="cat-un2001" name="cat-unyear"
                                        value="۲۰۰۱">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۲
                                    <input type="radio" id="cat-un2002" name="cat-unyear"
                                        value="۲۰۰۲">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>

                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۳
                                    <input type="radio" id="cat-un2003" name="cat-unyear"
                                        value="۲۰۰۳">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۴
                                    <input type="radio" id="cat-un2004" name="cat-unyear"
                                        value="۲۰۰۴">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۵
                                    <input type="radio" id="cat-un2005" name="cat-unyear"
                                        value="۲۰۰۵">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۶
                                    <input type="radio" id="cat-un2006" name="cat-unyear"
                                        value="۲۰۰۶">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۷
                                    <input type="radio" id="cat-un2007" name="cat-unyear"
                                        value="۲۰۰۷">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۸
                                    <input type="radio" id="cat-un2008" name="cat-unyear"
                                        value="۲۰۰۸">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۰۹
                                    <input type="radio" id="cat-un2009" name="cat-unyear"
                                        value="۲۰۰۹">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۰
                                    <input type="radio" id="cat-un2010" name="cat-unyear"
                                        value="۲۰۱۰">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۱
                                    <input type="radio" id="cat-un2011" name="cat-unyear"
                                        value="۲۰۱۱">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۲
                                    <input type="radio" id="cat-un2012" name="cat-unyear"
                                        value="۲۰۱۲">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۳
                                    <input type="radio" id="cat-un2013" name="cat-unyear"
                                        value="۲۰۱۳">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۴
                                    <input type="radio" id="cat-un2014" name="cat-unyear"
                                        value="۲۰۱۴">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>

                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۵
                                    <input type="radio" id="cat-un2015" name="cat-unyear"
                                        value="۲۰۱۵">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۶
                                    <input type="radio" id="cat-un2016" name="cat-unyear"
                                        value="۲۰۱۶">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۷
                                    <input type="radio" id="cat-un2017" name="cat-unyear"
                                        value="۲۰۱۷">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۸
                                    <input type="radio" id="cat-un2018" name="cat-unyear"
                                        value="۲۰۱۸">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۱۹
                                    <input type="radio" id="cat-un2019" name="cat-unyear"
                                        value="۲۰۱۹">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۲۰
                                    <input type="radio" id="cat-un2020" name="cat-unyear"
                                        value="۲۰۲۰">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                            <div class="cr-container">
                                <label class="custom-radio">
                                    ۲۰۲۱
                                    <input type="radio" id="cat-un2021" name="cat-unyear"
                                        value="۲۰۲۱">
                                    <span class="radio-mark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- year filter end -->
                <!-- --------------- -->
                <!-- --------------- -->

                <!-- country type start -->
                <div class="form-group-title SearchBoxTitle">
                    <a id="country" class="searchbox-btn" href="javascript:void(0)">کشور</a>
                </div>
                <div class="form-group-control min-searchfilter minSB">
                    <div class="cr-container">
                        <label class="custom-radio">
                            آمریکا
                            <input type="radio" id="cat-american" name="cat-country"
                                value="آمریکا" />
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            ایران
                            <input type="radio" id="cat-iran" name="cat-country" value="ایران">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            انگلستان
                            <input type="radio" id="cat-england" name="cat-country"
                                value="انگلستان">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            کانادا
                            <input type="radio" id="cat-canada" name="cat-country"
                                value="کانادا">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            فرانسه
                            <input type="radio" id="cat-france" name="cat-country"
                                value="فرانسه">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            کره جنوبی
                            <input type="radio" id="cat-korea" name="cat-country"
                                value="کره جنوبی">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            چین
                            <input type="radio" id="cat-china" name="cat-country" value="چین">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            هند
                            <input type="radio" id="cat-india" name="cat-country" value="هند">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            آلمان
                            <input type="radio" id="cat-germany" name="cat-country"
                                value="آلمان">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            ژاپن
                            <input type="radio" id="cat-japan" name="cat-country" value="ژاپن">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            استرالیا
                            <input type="radio" id="cat-australia" name="cat-country"
                                value="استرالیا">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            اسپانیا
                            <input type="radio" id="cat-spain" name="cat-country"
                                value="اسپانیا">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            بلژیک
                            <input type="radio" id="cat-belgium" name="cat-country"
                                value="بلژیک">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            هنگ کنگ
                            <input type="radio" id="cat-hongkong" name="cat-country"
                                value="هنگ کنگ">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            ایتالیا
                            <input type="radio" id="cat-italy" name="cat-country"
                                value="ایتالیا">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            روسیه
                            <input type="radio" id="cat-russia" name="cat-country"
                                value="روسیه">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            ایرلند
                            <input type="radio" id="cat-ereland" name="cat-country"
                                value="ایرلند">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            دانمارک
                            <input type="radio" id="cat-denmark" name="cat-country"
                                value="دانمارک">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            سوئد
                            <input type="radio" id="cat-sweden" name="cat-country" value="سوئد">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            نروژ
                            <input type="radio" id="cat-norway" name="cat-country" value="نروژ">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            لهستان
                            <input type="radio" id="cat-poland" name="cat-country"
                                value="لهستان">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            مجارستان
                            <input type="radio" id="cat-hungary" name="cat-country"
                                value="مجارستان">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            تایلند
                            <input type="radio" id="cat-thailand" name="cat-country"
                                value="تایلند">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            ترکیه
                            <input type="radio" id="cat-turkey" name="cat-country"
                                value="ترکیه">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            هلند
                            <input type="radio" id="cat-netherlands" name="cat-country"
                                value="هلند">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            سوئیس
                            <input type="radio" id="cat-swiss" name="cat-country" value="سوئیس">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            برزیل
                            <input type="radio" id="cat-brazil" name="cat-country"
                                value="برزیل">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            امارات متحده عربی
                            <input type="radio" id="cat-unitedarab" name="cat-country"
                                value="امارات متحده عربی">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            بنگلادش
                            <input type="radio" id="cat-bangladesh" name="cat-country"
                                value="بنگلادش">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            تاجیکستان
                            <input type="radio" id="cat-tajik" name="cat-country"
                                value="تاجیکستان">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            فنلاند
                            <input type="radio" id="cat-fanland" name="cat-country"
                                value="فنلاند">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            ارمنستان
                            <input type="radio" id="cat-armanestan" name="cat-country"
                                value="ارمنستان">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                </div>
                <!-- countery type end -->
                <!-- ----------------- -->
                <!-- ----------------- -->

                <!-- age type -->
                <div class="form-group-title SearchBoxTitle">
                    <a id="ages" class="searchbox-btn" href="javascript:void(0)">رده سنی</a>
                </div>
                <div class="form-group-control min-searchfilter minSB">
                    <div class="cr-container">
                        <label class="custom-radio">
                            همه سنین
                            <input type="radio" id="cat-na" name="cat-age" value="همه سنین" />
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            نیاز به نظارت والدین
                            <input type="radio" id="cat-na" name="cat-age" value="نیاز به نظارت والدین" />
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            +12
                            <input type="radio" id="cat-na" name="cat-age" value="12" />
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            +16
                            <input type="radio" id="cat-na" name="cat-age" value="16" />
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            فقط بزرگسالان
                            <input type="radio" id="cat-na" name="cat-age" value="فقط بزرگسالان" />
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                </div>
                <!-- age type end -->
                <!-- ------------ -->
                <!-- ------------ -->

                <!-- score -->
                <div class="form-group-title SearchBoxTitle">
                    <a id="score" class="searchbox-btn" href="javascript:void(0)">امتیاز</a>
                </div>
                <div class="form-group-control min-searchfilter minSB">
                    <div class="cr-container">
                        <label class="custom-radio">
                            ۰ تا ۲
                            <input type="radio" id="cat-0un2" name="cat-scores"
                                value="۰ تا ۲" />
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            ۲ تا ۵
                            <input type="radio" id="cat-2un5" name="cat-scores" value="۲ تا ۵">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            ۵ تا ۷
                            <input type="radio" id="cat-5un7" name="cat-scores" value="۵ تا ۷">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                    <div class="cr-container">
                        <label class="custom-radio">
                            بالای ۷
                            <input type="radio" id="cat-under7" name="cat-scores"
                                value="بالای ۷">
                            <span class="radio-mark"></span>
                        </label>
                    </div>
                </div>
                <!-- score end -->
                <!-- --------- -->
                <button class="FilterBoxBtn">جستجو</button>
                <!-- serach filter button -->
            </form>
            <!-- Search form fields end -->
        </div>
    </div>
</section>