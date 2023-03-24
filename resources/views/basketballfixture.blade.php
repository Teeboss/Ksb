@extends('layouts/pageHead')
<main class="marginTopSmallNavLong" style="background-color:  #F5F5F5;">
    <div class="mx-auto m-2 wid80 wid100Mobile d-block higt125px" style="overflow: hidden;">
        <img src="{{ asset('icons/1xbanner.png') }}" class="wid100" alt="">
    </div>
    <div class="d-block p-2 p-sm-0 mx-auto wid100Mobile wid50 bgWhite">
        <p class="white fontSize12px boldFive wid100 bgShaddyWhite p-2"><img src="{{ asset('icons/football/spain.png') }}" class="me-2" alt=""> spain: Leb Plata</p>
        <div class="wid100 p-2">
            <div class="d-block bgSocials wid100 mx-auto mt-5">
                <div class="d-block wid100Mobile wid70 mx-auto">
                    <div class="d-flex p-2 justify-content-between align-items-center">
                        <div class="d-flex align-items-center"><!-- width will help with the flex spacing -->
                            <span class="fontSize24px noWrap socialColorDeeper boldFive centerText">Zornotza ST</span>
                            <div class="d-lg-flex align-items-center ms-2 d-none">
                                <span class="fontSize6px marginRightStandings padSmall1 borderRA1 white boldFive standingRed">L</span>
                                <span class="fontSize6px marginRightStandings padSmall1 borderRA1 white boldFive standingGreen">W</span>
                                <span class="fontSize6px marginRightStandings padSmall1 borderRA1 white boldFive standingGreen">W</span>
                                <span class="fontSize6px marginRightStandings padSmall1 borderRA1 white boldFive standingGreen">W</span>
                                <span class="fontSize6px marginRightStandings padSmall1 borderRA1 white boldFive standingGrey">D</span>
                            </div>
                        </div>
                        <span class="boldFour bodyA mx-4 fontSize12px">02:00</span>
                        <div class="d-flex align-items-center">
                            <div class="d-lg-flex align-items-center me-3  d-none">
                                <span class="fontSize6px marginRightStandings padSmall1 borderRA1 white boldFive standingGreen">W</span>
                                <span class="fontSize6px marginRightStandings padSmall1 borderRA1 white boldFive standingGrey">D</span>
                                <span class="fontSize6px marginRightStandings padSmall1 borderRA1 white boldFive standingRed">L</span>
                                <span class="fontSize6px marginRightStandings padSmall1 borderRA1 white boldFive standingGreen">W</span>
                                <span class="fontSize6px marginRightStandings padSmall1 borderRA1 white boldFive standingGrey">D</span>
                            </div>
                            <span class="fontSize24px noWrap socialColorDeeper boldFive">Navarra</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-content-center m-5">
                <span class="fontSize14px bodyA ms-3 boldFour">Prediction</span>
                <span class="fontSize14px socialColorDeeper ms-3 boldFive">293</span>
                <span class="fontSize14px socialColorDeeper ms-3 boldFive">Home win</span>
            </div>
            <p class="fontSize12px boldFive p-2 bgSocials socialColorDeeper">Head to Head</p>
            <div class="d-block wid100 rounded-pill p-2 m-1 shadow-sm">
                <div class="ms-3 ms-sm-5 d-flex justify-content-between align-items-center wid40 wid30Mobile">
                    <span class="fontSize10px bodyA boldFour">06.01.2023</span>
                    <span class="fontSize12px socialColorDeeper boldFour">Zornotza ST</span>
                    <span class="fontSize14px socialColorDeeper boldFive">87 : 77</span>
                    <span class="fontSize12px socialColorDeeper boldFour">Navarra</span>
                </div>
            </div>
            <div class="d-block wid100 rounded-pill p-2 m-1 shadow-sm">
                <div class="ms-3 ms-sm-5 d-flex justify-content-between align-items-center wid40 wid30Mobile">
                    <span class="fontSize10px bodyA boldFour">06.01.2023</span>
                    <span class="fontSize12px socialColorDeeper boldFour">Navarra</span>
                    <span class="fontSize14px socialColorDeeper boldFive">70 : 92</span>
                    <span class="fontSize12px socialColorDeeper boldFour">Zornotza ST</span>
                </div>
            </div>
            <div class="d-block wid100 rounded-pill p-2 m-1 shadow-sm">
                <div class="ms-3 ms-sm-5 d-flex justify-content-between align-items-center wid40 wid30Mobile">
                    <span class="fontSize10px bodyA boldFour">06.01.2023</span>
                    <span class="fontSize12px socialColorDeeper boldFour">Navarra</span>
                    <span class="fontSize14px socialColorDeeper boldFive">79 : 71</span>
                    <span class="fontSize12px socialColorDeeper boldFour">Zornotza ST</span>
                </div>
            </div>
            <div class="d-block wid100 rounded-pill p-2 m-1 shadow-sm">
                <div class="ms-3 ms-sm-5 d-flex justify-content-between align-items-center wid40 wid30Mobile">
                    <span class="fontSize10px bodyA boldFour">06.01.2023</span>
                    <span class="fontSize12px socialColorDeeper boldFour">Zornotza ST</span>
                    <span class="fontSize14px socialColorDeeper boldFive">83 : 88</span>
                    <span class="fontSize12px socialColorDeeper boldFour">Navarra</span>
                </div>
            </div>

        </div>
        <div class="wid100 bgSocials p-3">
            <p class="fontSize12px boldFive ">Bet on this match on</p>
            <div class="d-flex flex-wrap justify-content-between">
                <img src="{{ asset('icons/bookmarks/btway.png') }}" class="wid45px" alt="">
                <img src="{{ asset('icons/bookmarks/everygame.png') }}" class="wid45px" alt="">
                <img src="{{ asset('icons/bookmarks/22b.png') }}" class="wid45px" alt="">
                <img src="{{ asset('icons/bookmarks/1win.png') }}" class="wid45px" alt="">
                <img src="{{ asset('icons/bookmarks/1xb.png') }}" class="wid45px" alt="">
            </div>
        </div>
        <div class="bgWhite d-flex flex-wrap justify-content-between wid100 py-3 px-1 py-sm-5">
            <div class="wid45 wid100Mobile">
                <span class="fontSize12px d-block boldFive p-2 bgSocials socialColorDeeper">Zornotza ST: Last results</span>
                <div class="d-flex my-1 justify-content-between p-2 align-items-center shadow-sm">
                    <div class="d-flex align-items-center">
                        <span class="fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen">W</span>
                        <span class="blackKsbTwo fontSize10px noWrap">Zornotza ST N Navarra</span>
                    </div>
                    <span class="fontSize10px blackKsbTwo">4:1</span>
                </div>
                <div class="d-flex my-1 justify-content-between p-2 align-items-center shadow-sm">
                    <div class="d-flex align-items-center">
                        <span class="fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen">W</span>
                        <span class="blackKsbTwo fontSize10px noWrap">Zornotza ST N Navarra</span>
                    </div>
                    <span class="fontSize10px blackKsbTwo">4:1</span>
                </div>
                <div class="d-flex my-1 justify-content-between p-2 align-items-center shadow-sm">
                    <div class="d-flex align-items-center">
                        <span class="fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen">W</span>
                        <span class="blackKsbTwo fontSize10px noWrap">Zornotza ST N Navarra</span>
                    </div>
                    <span class="fontSize10px blackKsbTwo">4:1</span>
                </div>
                <div class="d-flex my-1 justify-content-between p-2 align-items-center shadow-sm">
                    <div class="d-flex align-items-center">
                        <span class="fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen">W</span>
                        <span class="blackKsbTwo fontSize10px noWrap">Zornotza ST N Navarra</span>
                    </div>
                    <span class="fontSize10px blackKsbTwo">4:1</span>
                </div>
                <div class="d-flex my-1 justify-content-between p-2 align-items-center shadow-sm">
                    <div class="d-flex align-items-center">
                        <span class="fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen">W</span>
                        <span class="blackKsbTwo fontSize10px noWrap">Zornotza ST N Navarra</span>
                    </div>
                    <span class="fontSize10px blackKsbTwo">4:1</span>
                </div>
            </div>
            <div class="wid45 wid100Mobile">
                <span class="fontSize12px d-block boldFive p-2 bgSocials socialColorDeeper">Chalton: Last results</span>
                <div class="d-flex my-1 justify-content-between p-2 align-items-center shadow-sm">
                    <div class="d-flex align-items-center">
                        <span class="fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen">W</span>
                        <span class="blackKsbTwo fontSize10px noWrap">Chalton N Navarra</span>
                    </div>
                    <span class="fontSize10px blackKsbTwo">4:1</span>
                </div>
                <div class="d-flex my-1 justify-content-between p-2 align-items-center shadow-sm">
                    <div class="d-flex align-items-center">
                        <span class="fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen">W</span>
                        <span class="blackKsbTwo fontSize10px noWrap">Chalton N Navarra</span>
                    </div>
                    <span class="fontSize10px blackKsbTwo">4:1</span>
                </div>
                <div class="d-flex my-1 justify-content-between p-2 align-items-center shadow-sm">
                    <div class="d-flex align-items-center">
                        <span class="fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen">W</span>
                        <span class="blackKsbTwo fontSize10px noWrap">Chalton N Navarra</span>
                    </div>
                    <span class="fontSize10px blackKsbTwo">4:1</span>
                </div>
                <div class="d-flex my-1 justify-content-between p-2 align-items-center shadow-sm">
                    <div class="d-flex align-items-center">
                        <span class="fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen">W</span>
                        <span class="blackKsbTwo fontSize10px noWrap">Chalton N Navarra</span>
                    </div>
                    <span class="fontSize10px blackKsbTwo">4:1</span>
                </div>
                <div class="d-flex my-1 justify-content-between p-2 align-items-center shadow-sm">
                    <div class="d-flex align-items-center">
                        <span class="fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen">W</span>
                        <span class="blackKsbTwo fontSize10px noWrap">Chalton N Navarra</span>
                    </div>
                    <span class="fontSize10px blackKsbTwo">4:1</span>
                </div>
            </div>
        </div>
        <div class="mx-auto m-0 wid100 wid20Mobile d-block higt125px" style="overflow: hidden;">
            <img src="{{ asset('icons/1xbanner.png') }}" class="wid100" alt="">
        </div>
    </div>
</main>
@extends('layouts/footer')