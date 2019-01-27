<style type="text/css">

@keyframes logoBGRotate{
    0%{
        transform: rotate(0deg);
    }

    100%{
        transform: rotate(359deg);
    }

}

.logoContainer{
    position: relative;

    width: 200px;
    height: 200px;

    overflow: hidden;
}

.logoContainer img:nth-child(1){
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;

    image-rendering: crisp-edges;

    animation: logoBGRotate;
    animation-timing-function: linear;
    animation-duration: 30s;
    animation-iteration-count: infinite;
}

.logoContainer img:nth-child(2){
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;

    image-rendering: crisp-edges;
}


</style>


<div class="logoContainer">
    <img src="/content/LogoBackground.png" alt="" />
    <img src="/content/***REMOVED***.png" alt="" />
</div>
