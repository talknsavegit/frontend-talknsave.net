<style>
	/*!
* Responsive Video Gallery - A jQuery plugin that provides a slider with horizontal and vertical thumb layouts for video galleries.
* @version 1.0.9
* @link http://fooplugins.github.io/rvslider/
* @copyright Steven Usher & Brad Vincent 2015
* @license Released under the GPLv3 license.
*/

.rvs-item {
    width: 100% !important;
    height: 100% !important;
}

.rvs-container,
.rvs-empty,
.rvs-item,
.rvs-item-container,
.rvs-item-content,
.rvs-item-stage,
.rvs-item-text,
.rvs-nav-container,
.rvs-nav-item,
.rvs-nav-next,
.rvs-nav-prev,
.rvs-nav-stage {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box
}

.rvs-container {
    display: block;
    width: auto;
    height: 335px;
    max-width: 1280px;
    margin: 0 auto;
    position: relative;
    padding-right: 100px;
    font-family: 'Open Sans', 'Helvetica Neue', Arial, sans-serif
}

.rvs-item-container,
.rvs-nav-container {
    display: block;
    height: 100%;
    overflow: hidden
}

.rvs-empty {
    position: absolute;
    top: 0;
    left: 0;
    display: block;
    width: 100%;
    height: 100%;
    overflow: hidden;
    color: inherit
}

.rvs-item-container {
    height: 100%;
    background-color: inherit
}

.rvs-item-stage {
    height: 100%;
    max-height: 100%;
    position: relative;
    -webkit-transform: translateX(0);
    -moz-transform: translateX(0);
    transform: translateX(0);
    background-color: inherit
}

.rvs-item {
    display: block;
    height: 100%;
    position: absolute;
    top: 0;
    background: center center no-repeat;
    background-size: cover;
    background-color: inherit
}

.rvs-item-content,
.rvs-item-text {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    opacity: 0;
    margin: 0;
    -webkit-transform: translateY(-30px);
    -moz-transform: translateY(-30px);
    transform: translateY(-30px)
}

.rvs-item-content.rvs-bottom-center,
.rvs-item-content.rvs-bottom-left,
.rvs-item-content.rvs-bottom-right,
.rvs-item-text.rvs-bottom-center,
.rvs-item-text.rvs-bottom-left,
.rvs-item-text.rvs-bottom-right {
    top: auto;
    bottom: 0;
    -webkit-transform: translateY(30px);
    -moz-transform: translateY(30px);
    transform: translateY(30px)
}

.rvs-item-content.rvs-bottom-left,
.rvs-item-content.rvs-top-left,
.rvs-item-text.rvs-bottom-left,
.rvs-item-text.rvs-top-left {
    text-align: left
}

.rvs-item-content.rvs-bottom-right,
.rvs-item-content.rvs-top-right,
.rvs-item-text.rvs-bottom-right,
.rvs-item-text.rvs-top-right {
    text-align: right
}

.rvs-item-content.rvs-bottom-center,
.rvs-item-content.rvs-top-center,
.rvs-item-text.rvs-bottom-center,
.rvs-item-text.rvs-top-center {
    text-align: center
}

.rvs-active .rvs-item-content,
.rvs-active .rvs-item-text {
    opacity: 1;
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    transform: translateY(0)
}

.rvs-item-text {
    font-size: 14px;
    padding: 12px;
    text-shadow: 1px 1px 0 rgba(0, 0, 0, .2)
}

.rvs-item-text small {
    display: block;
    font-size: 80%;
    text-align: inherit
}

.rvs-hide-credits .rvs-item-text small {
    display: none
}

.rvs-player {
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background-color: inherit
}

.rvs-player>video {
    background-color: #000
}

.rvs-container a.rvs-close,
.rvs-container a.rvs-play-video {
    position: absolute;
    display: inline-block;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    padding: 0;
    text-decoration: none;
    outline: 0;
    opacity: 0;
    box-shadow: none
}

.rvs-container a.rvs-close:active,
.rvs-container a.rvs-close:focus,
.rvs-container a.rvs-close:hover,
.rvs-container a.rvs-play-video:active,
.rvs-container a.rvs-play-video:focus,
.rvs-container a.rvs-play-video:hover {
    text-decoration: none;
    outline: 0;
    border: none;
    box-shadow: none
}

.rvs-container a.rvs-close {
    top: 10px;
    left: 10px;
    width: 36px;
    height: 36px;
    font-size: 28px;
    font-weight: 700;
    z-index: 2
}

.rvs-container a.rvs-play-video {
    top: 50%;
    left: 50%;
    width: 60px;
    height: 60px;
    font-size: 32px;
    -webkit-transform: translateX(-50%) translateY(-50%);
    -ms-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%)
}

.rvs-container .rvs-active a.rvs-play-video,
.rvs-container .rvs-player:hover a.rvs-close {
    opacity: 1
}

.rvs-container.rvs-show-play-on-hover .rvs-active a.rvs-play-video {
    opacity: 0
}

.rvs-container.rvs-show-play-on-hover .rvs-active:hover a.rvs-play-video {
    opacity: 1
}

.rvs-container .rvs-video-active a.rvs-play-video {
    display: none
}

.rvs-player-error {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    text-align: center;
    background-color: inherit
}

.rvs-error-icon {
    display: inline-block;
    position: relative;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    border-style: solid;
    border-radius: 50%;
    background-color: #CA3030;
    border-width: 12px;
    width: 140px;
    height: 140px;
    font-size: 180px
}

.rvs-nav-container {
    width: 100px;
    position: absolute;
    top: 0;
    right: 0
}

.rvs-nav-container a.rvs-nav-next,
.rvs-nav-container a.rvs-nav-prev {
    display: block;
    position: absolute;
    left: 0;
    width: 100%;
    padding: 6px 8px;
    font-size: 16px;
    font-weight: 700;
    opacity: 0;
    outline: 0;
    text-decoration: none;
    cursor: pointer;
    z-index: 2
}

.rvs-nav-container:hover a.rvs-nav-next,
.rvs-nav-container:hover a.rvs-nav-prev {
    opacity: .5
}

.rvs-nav-container a.rvs-nav-next:hover,
.rvs-nav-container a.rvs-nav-prev:hover {
    color: inherit;
    text-decoration: none;
    opacity: 1
}

.rvs-nav-container a.rvs-nav-prev {
    top: 0;
    border-bottom: solid 1px transparent
}

.rvs-nav-container a.rvs-nav-next {
    bottom: 0;
    border-top: solid 1px transparent
}

.rvs-nav-container a.rvs-nav-stage {
    -webkit-transform: translateX(0) translateY(-1px);
    -ms-transform: translateX(0) translateY(-1px);
    transform: translateX(0) translateY(-1px);
    width: 100%;
    z-index: 1
}

.rvs-nav-container a.rvs-nav-item {
    display: block;
    position: relative;
    width: 100%;
    height: 56px;
    padding: 4px 6px;
    border-top: solid 1px transparent;
    cursor: pointer;
    overflow: hidden;
    outline: 0;
    text-decoration: none;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none
}

.rvs-nav-container a.rvs-nav-item:hover {
    color: inherit;
    text-decoration: none;
    outline: 0
}

.rvs-nav-container a.rvs-nav-item:before {
    display: table;
    content: ' '
}

.rvs-nav-container a.rvs-nav-item:first-child {
    border-top-color: transparent;
    border-top-width: 2px
}

.rvs-nav-container span.rvs-nav-item-thumb {
    float: left;
    margin-left: -8px;
    margin-right: 8px;
    width: 60px;
    height: 60px;
    background: center center no-repeat;
    background-size: cover
}

.rvs-nav-container h4.rvs-nav-item-title,
.rvs-nav-container small.rvs-nav-item-credits {
    display: block;
    line-height: 15px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    clear: none
}

.rvs-nav-container h4.rvs-nav-item-title {
    font-size: 12px
}

.rvs-nav-container small.rvs-nav-item-credits {
    max-height: 15px;
    font-size: 11px;
    margin: 0
}

.rvs-thumb-play .rvs-nav-container span.rvs-nav-item-thumb:before {
    padding: 6px 7px 8px;
    border-radius: 4px;
    display: inline-block;
    width: 28px;
    height: 28px
}

.rvs-thumb-play .rvs-nav-container .rvs-video-active span.rvs-nav-item-thumb:before {
    padding: 1px 8px 7px;
    font-size: 20px
}

.rvs-large-thumbs .rvs-nav-container span.rvs-nav-item-thumb {
    height: 60px;
    width: 98px
}

.rvs-hide-credits .rvs-nav-container small.rvs-nav-item-credits {
    display: none
}

.rvs-hide-credits .rvs-nav-container h4.rvs-nav-item-title {
    white-space: normal
}

.rvs-animate .rvs-item-stage,
.rvs-animate .rvs-nav-stage {
    width: 100% !important;
    -webkit-transition: -webkit-transform .6s cubic-bezier(.445, .05, .55, .95);
    -moz-transition: -moz-transform .6s cubic-bezier(.445, .05, .55, .95);
    transition: transform .6s cubic-bezier(.445, .05, .55, .95)
}

.rvs-animate .rvs-nav-item {
    -webkit-transition: background-color .6s cubic-bezier(.445, .05, .55, .95), border-color .6s cubic-bezier(.445, .05, .55, .95);
    -moz-transition: background-color .6s cubic-bezier(.445, .05, .55, .95), border-color .6s cubic-bezier(.445, .05, .55, .95);
    transition: background-color .6s cubic-bezier(.445, .05, .55, .95), border-color .6s cubic-bezier(.445, .05, .55, .95)
}

.rvs-animate .rvs-close,
.rvs-animate .rvs-play-video {
    -webkit-transition: background-color .15s cubic-bezier(.445, .05, .55, .95), color .15s cubic-bezier(.445, .05, .55, .95), opacity .15s cubic-bezier(.445, .05, .55, .95), border-color .15s cubic-bezier(.445, .05, .55, .95);
    -moz-transition: background-color .15s cubic-bezier(.445, .05, .55, .95), color .15s cubic-bezier(.445, .05, .55, .95), opacity .15s cubic-bezier(.445, .05, .55, .95), border-color .15s cubic-bezier(.445, .05, .55, .95);
    transition: background-color .15s cubic-bezier(.445, .05, .55, .95), color .15s cubic-bezier(.445, .05, .55, .95), opacity .15s cubic-bezier(.445, .05, .55, .95), border-color .15s cubic-bezier(.445, .05, .55, .95)
}

.rvs-animate .rvs-item-content,
.rvs-animate .rvs-item-text {
    -webkit-transition: opacity .6s cubic-bezier(.445, .05, .55, .95), -webkit-transform .6s cubic-bezier(.445, .05, .55, .95);
    -moz-transition: opacity .6s cubic-bezier(.445, .05, .55, .95), -moz-transform .6s cubic-bezier(.445, .05, .55, .95);
    transition: opacity .6s cubic-bezier(.445, .05, .55, .95), transform .6s cubic-bezier(.445, .05, .55, .95)
}

.rvs-animate .rvs-nav-next,
.rvs-animate .rvs-nav-prev {
    -webkit-transition: opacity .5s cubic-bezier(.445, .05, .55, .95);
    -moz-transition: opacity .5s cubic-bezier(.445, .05, .55, .95);
    transition: opacity .5s cubic-bezier(.445, .05, .55, .95);
    transition-delay: .5s
}

.rvs-animate .rvs-nav-next:hover,
.rvs-animate .rvs-nav-prev:hover {
    transition-delay: 0s
}

.rvs-animate .rvs-nav-item h4,
.rvs-animate .rvs-nav-item small {
    -webkit-transition: color .5s cubic-bezier(.445, .05, .55, .95);
    -moz-transition: color .5s cubic-bezier(.445, .05, .55, .95);
    transition: color .5s cubic-bezier(.445, .05, .55, .95)
}

.rvs-animate .rvs-nav-item span {
    -webkit-transition: background-color .5s cubic-bezier(.445, .05, .55, .95);
    -moz-transition: background-color .5s cubic-bezier(.445, .05, .55, .95);
    transition: background-color .5s cubic-bezier(.445, .05, .55, .95)
}

.rvs-container.rvs-xs.rvs-sm {
    padding-right: 150px
}

.rvs-xs.rvs-sm .rvs-item-text {
    font-size: 16px;
    padding: 14px
}

.rvs-xs.rvs-sm .rvs-nav-container {
    width: 150px
}

.rvs-container.rvs-xs.rvs-sm.rvs-md {
    height: 467px;
    padding-right: 220px
}

.rvs-xs.rvs-sm.rvs-md .rvs-item-text {
    font-size: 18px;
    padding: 16px
}

.rvs-xs.rvs-sm.rvs-md .rvs-nav-container {
    width: 220px
}

.rvs-xs.rvs-sm.rvs-md .rvs-nav-container a.rvs-nav-item {
    height: 78px;
    padding: 8px 16px
}

.rvs-xs.rvs-sm.rvs-md .rvs-nav-container h4.rvs-nav-item-title {
    margin: 10px 0 2px;
    max-height: 40px;
    line-height: 20px;
    font-size: 16px
}

.rvs-xs.rvs-sm.rvs-md .rvs-nav-container small.rvs-nav-item-credits {
    font-size: 14px
}

.rvs-xs.rvs-sm.rvs-md .rvs-nav-container span.rvs-nav-item-thumb {
    display: block
}

.rvs-xs.rvs-sm.rvs-md .rvs-error-icon {
    border-width: 18px;
    width: 200px;
    height: 200px;
    font-size: 250px
}

.rvs-container.rvs-xs.rvs-sm.rvs-md.rvs-lg {
    height: 545px;
    padding-right: 280px
}

.rvs-xs.rvs-sm.rvs-md.rvs-lg .rvs-item-text {
    font-size: 20px;
    padding: 20px
}

.rvs-container.rvs-bordered-circle-play a.rvs-play-video:before,
.rvs-container.rvs-flat-circle-play a.rvs-play-video:before {
    padding-left: 4px
}

.rvs-xs.rvs-sm.rvs-md.rvs-lg .rvs-nav-container {
    width: 280px
}

.rvs-container.rvs-horizontal {
    padding-right: 0;
    padding-bottom: 56px
}

.rvs-horizontal .rvs-item-container,
.rvs-horizontal .rvs-nav-container {
    width: 100%
}

.rvs-horizontal .rvs-nav-container {
    height: 56px;
    top: auto;
    bottom: 0
}

.rvs-horizontal .rvs-nav-container a.rvs-nav-next,
.rvs-horizontal .rvs-nav-container a.rvs-nav-prev {
    left: auto;
    top: 0;
    width: auto;
    height: 56px;
    line-height: 56px;
    border-top: none;
    border-bottom: none
}

.rvs-horizontal .rvs-nav-container a.rvs-nav-prev {
    top: auto;
    left: 0;
    border-right-style: solid;
    border-right-width: 1px
}

.rvs-horizontal .rvs-nav-container a.rvs-nav-next {
    bottom: auto;
    right: 0;
    border-left-style: solid;
    border-left-width: 1px
}

.rvs-horizontal .rvs-nav-container .rvs-nav-stage {
    -webkit-transform: translateX(0) translateY(0);
    -ms-transform: translateX(0) translateY(0);
    transform: translateX(0) translateY(0);
    height: 100%
}

.rvs-horizontal .rvs-nav-container a.rvs-nav-item {
    position: absolute;
    top: 0;
    left: 0;
    width: 100px;
    height: 100%;
    border-top: none;
    border-left-style: solid;
    border-left-width: 1px
}

.rvs-horizontal .rvs-nav-container a.rvs-nav-item:first-child {
    border-left-color: transparent;
    border-left-width: 2px
}

.rvs-large-thumbs.rvs-horizontal .rvs-nav-container span.rvs-nav-item-thumb {
    width: 60px;
    height: 60px
}

.rvs-horizontal.rvs-xs.rvs-sm .rvs-nav-container,
.rvs-horizontal.rvs-xs.rvs-sm.rvs-md.rvs-lg .rvs-nav-container {
    width: 100%
}

.rvs-container.rvs-horizontal.rvs-xs.rvs-sm {
    padding-right: 0;
    height: 420px
}

.rvs-container.rvs-horizontal.rvs-xs.rvs-sm.rvs-md {
    padding-right: 0;
    padding-bottom: 78px;
    height: 520px
}

.rvs-horizontal.rvs-xs.rvs-sm.rvs-md .rvs-nav-container a.rvs-nav-next,
.rvs-horizontal.rvs-xs.rvs-sm.rvs-md .rvs-nav-container a.rvs-nav-prev {
    height: 100%;
    line-height: 78px
}

.rvs-horizontal.rvs-xs.rvs-sm.rvs-md .rvs-nav-container {
    width: 100%;
    height: 78px
}

.rvs-horizontal.rvs-xs.rvs-sm.rvs-md .rvs-nav-container a.rvs-nav-item {
    height: 100%
}

.rvs-container.rvs-horizontal.rvs-xs.rvs-sm.rvs-md.rvs-lg {
    height: 546px;
    padding-right: 0
}

.rvs-close,
.rvs-error-icon,
.rvs-nav-next,
.rvs-nav-prev,
.rvs-play-video,
.rvs-thumb-play .rvs-nav-item-thumb {
    font-family: "Andale Mono", Arial, "Courier New", sans-serif;
    line-height: 1;
    text-align: center
}

.rvs-close:before,
.rvs-error-icon:before,
.rvs-horizontal .rvs-nav-next:before,
.rvs-horizontal .rvs-nav-prev:before,
.rvs-play-video:before,
.rvs-thumb-play .rvs-nav-item-thumb:before {
    display: inline-block;
    position: relative;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%)
}

.rvs-horizontal .rvs-nav-next,
.rvs-horizontal .rvs-nav-prev {
    width: auto;
    height: 78px
}

.rvs-play-video:before,
.rvs-thumb-play .rvs-nav-item-thumb:before {
    content: '\25ba'
}

.rvs-thumb-play .rvs-video-active .rvs-nav-item-thumb:before {
    content: '\25A0'
}

.rvs-nav-prev:before {
    content: '\25b2'
}

.rvs-nav-next:before {
    content: '\25bc'
}

.rvs-horizontal .rvs-nav-prev:before {
    content: '\25c0'
}

.rvs-horizontal .rvs-nav-next:before {
    content: '\25b6'
}

.rvs-container.rvs-flat-circle-play a.rvs-play-video {
    border-radius: 50%
}

.rvs-container.rvs-plain-arrow-play .rvs-item a.rvs-play-video,
.rvs-container.rvs-plain-arrow-play .rvs-item a.rvs-play-video:active,
.rvs-container.rvs-plain-arrow-play .rvs-item a.rvs-play-video:focus,
.rvs-container.rvs-plain-arrow-play .rvs-item a.rvs-play-video:hover {
    background-color: transparent;
    font-size: 50px
}

.rvs-container.rvs-youtube-play a.rvs-play-video {
    border-radius: 50%/15%;
    font-size: 24px;
    height: 42px
}

.rvs-container.rvs-bordered-circle-play .rvs-item a.rvs-play-video,
.rvs-container.rvs-bordered-circle-play .rvs-item a.rvs-play-video:active,
.rvs-container.rvs-bordered-circle-play .rvs-item a.rvs-play-video:focus,
.rvs-container.rvs-bordered-circle-play .rvs-item a.rvs-play-video:hover {
    background-color: transparent;
    border-radius: 50%;
    border-width: 4px;
    border-style: solid
}

.rvs-container,
.rvs-container a.rvs-close,
.rvs-container a.rvs-close:active,
.rvs-container a.rvs-close:focus,
.rvs-container a.rvs-close:hover,
.rvs-container a.rvs-nav-next,
.rvs-container a.rvs-nav-next:active,
.rvs-container a.rvs-nav-next:focus,
.rvs-container a.rvs-nav-next:hover,
.rvs-container a.rvs-nav-prev,
.rvs-container a.rvs-nav-prev:active,
.rvs-container a.rvs-nav-prev:focus,
.rvs-container a.rvs-nav-prev:hover,
.rvs-container a.rvs-play-video,
.rvs-container a.rvs-play-video:active,
.rvs-container a.rvs-play-video:focus,
.rvs-container a.rvs-play-video:hover,
.rvs-item-text,
.rvs-nav-item-title,
.rvs-thumb-play .rvs-nav-item-thumb:before,
.rvs-thumb-play .rvs-nav-item-thumb:hover:before {
    color: #FFF
}

.rvs-container a.rvs-play-video,
.rvs-container a.rvs-play-video:active,
.rvs-container a.rvs-play-video:focus,
.rvs-container a.rvs-play-video:hover {
    border-color: #FFF
}

.rvs-nav-item-credits {
    color: #767676
}

.rvs-container a.rvs-close,
.rvs-container a.rvs-play-video,
.rvs-nav-container span.rvs-nav-item-thumb,
.rvs-thumb-play .rvs-nav-container span.rvs-nav-item-thumb:before {
    background-color: rgba(23, 35, 34, .75)
}

.rvs-container,
.rvs-container a.rvs-nav-next,
.rvs-container a.rvs-nav-prev {
    background-color: #151515
}

.rvs-container a.rvs-nav-item:active,
.rvs-container a.rvs-nav-item:focus,
.rvs-container a.rvs-nav-item:hover,
.rvs-container a.rvs-nav-next:active,
.rvs-container a.rvs-nav-next:focus,
.rvs-container a.rvs-nav-next:hover,
.rvs-container a.rvs-nav-prev:active,
.rvs-container a.rvs-nav-prev:focus,
.rvs-container a.rvs-nav-prev:hover {
    background-color: #000
}

.rvs-container a.rvs-nav-item,
.rvs-container a.rvs-nav-item:active,
.rvs-container a.rvs-nav-item:focus,
.rvs-container a.rvs-nav-item:hover,
.rvs-container a.rvs-nav-next,
.rvs-container a.rvs-nav-next:active,
.rvs-container a.rvs-nav-next:focus,
.rvs-container a.rvs-nav-next:hover,
.rvs-container a.rvs-nav-prev,
.rvs-container a.rvs-nav-prev:active,
.rvs-container a.rvs-nav-prev:focus,
.rvs-container a.rvs-nav-prev:hover,
.rvs-nav-container {
    border-color: #2E2E2E
}

.rvs-container a.rvs-nav-item:first-child {
    border-color: #151515
}

.rvs-container a.rvs-nav-item:first-child:focus,
.rvs-container a.rvs-nav-item:first-child:hover {
    border-color: #000
}

.rvs-light .rvs-nav-item-title,
.rvs-light.rvs-container,
.rvs-light.rvs-container a.rvs-nav-next,
.rvs-light.rvs-container a.rvs-nav-next:active,
.rvs-light.rvs-container a.rvs-nav-next:focus,
.rvs-light.rvs-container a.rvs-nav-next:hover,
.rvs-light.rvs-container a.rvs-nav-prev,
.rvs-light.rvs-container a.rvs-nav-prev:active,
.rvs-light.rvs-container a.rvs-nav-prev:focus,
.rvs-light.rvs-container a.rvs-nav-prev:hover {
    color: #333
}

.rvs-light .rvs-nav-item-credits {
    color: #767676
}

.rvs-light.rvs-container,
.rvs-light.rvs-container a.rvs-nav-next,
.rvs-light.rvs-container a.rvs-nav-prev {
    background-color: #FFF
}

.rvs-light.rvs-container a.rvs-nav-item:active,
.rvs-light.rvs-container a.rvs-nav-item:focus,
.rvs-light.rvs-container a.rvs-nav-item:hover,
.rvs-light.rvs-container a.rvs-nav-next:active,
.rvs-light.rvs-container a.rvs-nav-next:focus,
.rvs-light.rvs-container a.rvs-nav-next:hover,
.rvs-light.rvs-container a.rvs-nav-prev:active,
.rvs-light.rvs-container a.rvs-nav-prev:focus,
.rvs-light.rvs-container a.rvs-nav-prev:hover {
    background-color: #F9F9F9
}

.rvs-container a.rvs-light .rvs-nav-prev:focus,
.rvs-light .rvs-nav-container,
.rvs-light.rvs-container a.rvs-nav-item,
.rvs-light.rvs-container a.rvs-nav-item:active,
.rvs-light.rvs-container a.rvs-nav-item:focus,
.rvs-light.rvs-container a.rvs-nav-item:hover,
.rvs-light.rvs-container a.rvs-nav-next,
.rvs-light.rvs-container a.rvs-nav-next:active,
.rvs-light.rvs-container a.rvs-nav-next:focus,
.rvs-light.rvs-container a.rvs-nav-next:hover,
.rvs-light.rvs-container a.rvs-nav-prev,
.rvs-light.rvs-container a.rvs-nav-prev:active,
.rvs-light.rvs-container a.rvs-nav-prev:hover {
    border-color: #e2e2e2
}

.rvs-light.rvs-container a.rvs-nav-item:first-child {
    border-color: #FFF
}

.rvs-light.rvs-container a.rvs-nav-item:first-child:focus,
.rvs-light.rvs-container a.rvs-nav-item:first-child:hover {
    border-color: #F9F9F9
}

.rvs-container a.rvs-close:active,
.rvs-container a.rvs-close:focus,
.rvs-container a.rvs-close:hover,
.rvs-container a.rvs-nav-item.rvs-active,
.rvs-container a.rvs-nav-item.rvs-active:active,
.rvs-container a.rvs-nav-item.rvs-active:focus,
.rvs-container a.rvs-nav-item.rvs-active:hover,
.rvs-container a.rvs-play-video:active,
.rvs-container a.rvs-play-video:focus,
.rvs-container a.rvs-play-video:hover,
.rvs-container.rvs-thumb-play .rvs-nav-container .rvs-video-active span.rvs-nav-item-thumb:before,
.rvs-container.rvs-thumb-play .rvs-nav-container span.rvs-nav-item-thumb:hover:before {
    background-color: #7816D6
}

.rvs-container a.rvs-nav-item.rvs-active,
.rvs-container a.rvs-nav-item.rvs-active:active,
.rvs-container a.rvs-nav-item.rvs-active:first-child,
.rvs-container a.rvs-nav-item.rvs-active:first-child:active,
.rvs-container a.rvs-nav-item.rvs-active:first-child:focus,
.rvs-container a.rvs-nav-item.rvs-active:first-child:hover,
.rvs-container a.rvs-nav-item.rvs-active:focus,
.rvs-container a.rvs-nav-item.rvs-active:hover,
.rvs-container a.rvs-play-video:active,
.rvs-container a.rvs-play-video:focus,
.rvs-container a.rvs-play-video:hover {
    border-color: #7816D6
}

.rvs-container .rvs-active .rvs-nav-item-credits,
.rvs-container .rvs-active .rvs-nav-item-title {
    color: #FFF
}

.rvs-green-highlight.rvs-container a.rvs-close:active,
.rvs-green-highlight.rvs-container a.rvs-close:focus,
.rvs-green-highlight.rvs-container a.rvs-close:hover,
.rvs-green-highlight.rvs-container a.rvs-nav-item.rvs-active,
.rvs-green-highlight.rvs-container a.rvs-nav-item.rvs-active:active,
.rvs-green-highlight.rvs-container a.rvs-nav-item.rvs-active:focus,
.rvs-green-highlight.rvs-container a.rvs-nav-item.rvs-active:hover,
.rvs-green-highlight.rvs-container a.rvs-play-video:active,
.rvs-green-highlight.rvs-container a.rvs-play-video:focus,
.rvs-green-highlight.rvs-container a.rvs-play-video:hover,
.rvs-green-highlight.rvs-thumb-play .rvs-nav-container .rvs-video-active span.rvs-nav-item-thumb:before,
.rvs-green-highlight.rvs-thumb-play .rvs-nav-container span.rvs-nav-item-thumb:hover:before {
    background-color: #02874A
}

.rvs-green-highlight.rvs-container a.rvs-nav-item.rvs-active,
.rvs-green-highlight.rvs-container a.rvs-nav-item.rvs-active:active,
.rvs-green-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child,
.rvs-green-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child:active,
.rvs-green-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child:focus,
.rvs-green-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child:hover,
.rvs-green-highlight.rvs-container a.rvs-nav-item.rvs-active:focus,
.rvs-green-highlight.rvs-container a.rvs-nav-item.rvs-active:hover,
.rvs-green-highlight.rvs-container a.rvs-play-video:active,
.rvs-green-highlight.rvs-container a.rvs-play-video:focus,
.rvs-green-highlight.rvs-container a.rvs-play-video:hover {
    border-color: #02874A
}

.rvs-blue-highlight.rvs-container a.rvs-close:active,
.rvs-blue-highlight.rvs-container a.rvs-close:focus,
.rvs-blue-highlight.rvs-container a.rvs-close:hover,
.rvs-blue-highlight.rvs-container a.rvs-nav-item.rvs-active,
.rvs-blue-highlight.rvs-container a.rvs-nav-item.rvs-active:active,
.rvs-blue-highlight.rvs-container a.rvs-nav-item.rvs-active:focus,
.rvs-blue-highlight.rvs-container a.rvs-nav-item.rvs-active:hover,
.rvs-blue-highlight.rvs-container a.rvs-play-video:active,
.rvs-blue-highlight.rvs-container a.rvs-play-video:focus,
.rvs-blue-highlight.rvs-container a.rvs-play-video:hover,
.rvs-blue-highlight.rvs-thumb-play .rvs-nav-container .rvs-video-active span.rvs-nav-item-thumb:before,
.rvs-blue-highlight.rvs-thumb-play .rvs-nav-container span.rvs-nav-item-thumb:hover:before {
    background-color: #0087be
}

.rvs-blue-highlight.rvs-container a.rvs-nav-item.rvs-active,
.rvs-blue-highlight.rvs-container a.rvs-nav-item.rvs-active:active,
.rvs-blue-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child,
.rvs-blue-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child:active,
.rvs-blue-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child:focus,
.rvs-blue-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child:hover,
.rvs-blue-highlight.rvs-container a.rvs-nav-item.rvs-active:focus,
.rvs-blue-highlight.rvs-container a.rvs-nav-item.rvs-active:hover,
.rvs-blue-highlight.rvs-container a.rvs-play-video:active,
.rvs-blue-highlight.rvs-container a.rvs-play-video:focus,
.rvs-blue-highlight.rvs-container a.rvs-play-video:hover {
    border-color: #0087be
}

.rvs-orange-highlight.rvs-container a.rvs-close:active,
.rvs-orange-highlight.rvs-container a.rvs-close:focus,
.rvs-orange-highlight.rvs-container a.rvs-close:hover,
.rvs-orange-highlight.rvs-container a.rvs-nav-item.rvs-active,
.rvs-orange-highlight.rvs-container a.rvs-nav-item.rvs-active:active,
.rvs-orange-highlight.rvs-container a.rvs-nav-item.rvs-active:focus,
.rvs-orange-highlight.rvs-container a.rvs-nav-item.rvs-active:hover,
.rvs-orange-highlight.rvs-container a.rvs-play-video:active,
.rvs-orange-highlight.rvs-container a.rvs-play-video:focus,
.rvs-orange-highlight.rvs-container a.rvs-play-video:hover,
.rvs-orange-highlight.rvs-thumb-play .rvs-nav-container .rvs-video-active span.rvs-nav-item-thumb:before,
.rvs-orange-highlight.rvs-thumb-play .rvs-nav-container span.rvs-nav-item-thumb:hover:before {
    background-color: #FF8E31
}

.rvs-orange-highlight.rvs-container a.rvs-nav-item.rvs-active,
.rvs-orange-highlight.rvs-container a.rvs-nav-item.rvs-active:active,
.rvs-orange-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child,
.rvs-orange-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child:active,
.rvs-orange-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child:focus,
.rvs-orange-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child:hover,
.rvs-orange-highlight.rvs-container a.rvs-nav-item.rvs-active:focus,
.rvs-orange-highlight.rvs-container a.rvs-nav-item.rvs-active:hover,
.rvs-orange-highlight.rvs-container a.rvs-play-video:active,
.rvs-orange-highlight.rvs-container a.rvs-play-video:focus,
.rvs-orange-highlight.rvs-container a.rvs-play-video:hover {
    border-color: #FF8E31
}

.rvs-red-highlight.rvs-container a.rvs-close:active,
.rvs-red-highlight.rvs-container a.rvs-close:focus,
.rvs-red-highlight.rvs-container a.rvs-close:hover,
.rvs-red-highlight.rvs-container a.rvs-nav-item.rvs-active,
.rvs-red-highlight.rvs-container a.rvs-nav-item.rvs-active:active,
.rvs-red-highlight.rvs-container a.rvs-nav-item.rvs-active:focus,
.rvs-red-highlight.rvs-container a.rvs-nav-item.rvs-active:hover,
.rvs-red-highlight.rvs-container a.rvs-play-video:active,
.rvs-red-highlight.rvs-container a.rvs-play-video:focus,
.rvs-red-highlight.rvs-container a.rvs-play-video:hover,
.rvs-red-highlight.rvs-thumb-play .rvs-nav-container .rvs-video-active span.rvs-nav-item-thumb:before,
.rvs-red-highlight.rvs-thumb-play .rvs-nav-container span.rvs-nav-item-thumb:hover:before {
    background-color: #F12B24
}

.rvs-red-highlight.rvs-container a.rvs-nav-item.rvs-active,
.rvs-red-highlight.rvs-container a.rvs-nav-item.rvs-active:active,
.rvs-red-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child,
.rvs-red-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child:active,
.rvs-red-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child:focus,
.rvs-red-highlight.rvs-container a.rvs-nav-item.rvs-active:first-child:hover,
.rvs-red-highlight.rvs-container a.rvs-nav-item.rvs-active:focus,
.rvs-red-highlight.rvs-container a.rvs-nav-item.rvs-active:hover,
.rvs-red-highlight.rvs-container a.rvs-play-video:active,
.rvs-red-highlight.rvs-container a.rvs-play-video:focus,
.rvs-red-highlight.rvs-container a.rvs-play-video:hover {
    border-color: #F12B24
}
	</style>
<style>
					.center_content<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						position:absolute;
						overflow:visible;
						top:50%;
						left:50%;
						width:100%;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
					}
					#RW_Load_RS_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						position:relative;
						margin:20px auto !important;
						background-color:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_BgC); ?> !important;
						z-index:2;
						width:750px;
						padding-bottom:50%;
						max-width:100% !important;
					}
					<?php if($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_S == "small") { ?>
						.RW_Loader_Frame_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?> { width:45px !important; height:45px !important; }
						.loader_Navigation1<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							border-top: 3px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T1_C); ?> !important;
							border-bottom: 3px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T1_C); ?> !important;
						}
						.loader_Navigation2<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							border-top: 3px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T2_C); ?> !important;
							border-bottom: 3px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T2_C); ?> !important;
						}
						.loader_Navigation3<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							border-top:12px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T3_C); ?> !important;
							border-bottom:12px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T3_C); ?> !important;
							border-right:12px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T3_C); ?> !important;
							width:50% !important;
							height:50% !important;
						}
					<?php } elseif($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_S == "middle") { ?>
						.RW_Loader_Frame_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?> { width:60px !important; height:60px !important; }
						.loader_Navigation1<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							border-top: 4px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T1_C); ?> !important;
							border-bottom: 4px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T1_C); ?> !important;
						}
						.loader_Navigation2<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							border-top: 4px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T2_C); ?> !important;
							border-bottom: 4px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T2_C); ?> !important;
						}
						.loader_Navigation3<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							border-top:17px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T3_C); ?> !important;
							border-bottom:17px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T3_C); ?> !important;
							border-right:17px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T3_C); ?> !important;
							width:55% !important;
							height:55% !important;
						}
					<?php } else { ?>
						.RW_Loader_Frame_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?> { width:80px !important; height:80px !important; }
						.loader_Navigation1<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							border-top: 5px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T1_C); ?> !important;
							border-bottom: 5px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T1_C); ?> !important;
						}
						.loader_Navigation2<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							border-top: 5px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T2_C); ?> !important;
							border-bottom: 5px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T2_C); ?> !important;
						}
						.loader_Navigation3<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							border-top:25px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T3_C); ?> !important;
							border-bottom:25px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T3_C); ?> !important;
							border-right:25px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_T3_C); ?> !important;
							width:60% !important;
							height:60% !important;
						}
					<?php } ?>
					.RW_Loader_Frame_Navigation
					{
						position:relative;
						left:50%;
						width:80px;
						height:80px;
						transform:translateX(-50%);
						-webkit-transform:translateX(-50%);
						-ms-transform:translateX(-50%);
						-moz-transform:translateX(-50%);
						-o-transform:translateX(-50%);
					}
					.RW_Loader_Text_Navigation<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						position:relative;
						text-align:center;
						margin-top:10px;
						font-size: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_FS); ?>px !important;
						font-family:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_FF); ?> !important;
						color: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_C); ?> !important;
					}
					.loader_Navigation1,.loader_Navigation2,.loader_Navigation3,.loader_Navigation4 { position:absolute; border:5px solid transparent; border-radius:50%; }
					.loader_Navigation1<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						box-sizing:border-box;
						-webkit-box-sizing:border-box;
						-ms-box-sizing:border-box;
						-moz-box-sizing:border-box;
						-o-box-sizing:border-box;
					}
					.loader_Navigation2<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						-webkit-box-sizing:border-box;
						-ms-box-sizing:border-box;
						-moz-box-sizing:border-box;
						-o-box-sizing:border-box;
						top:50%;
						left:50%;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);	
					}
					.loader_Navigation3<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						width:60%;
						height:60%;
						top:50%;
						left:50%;
						box-sizing:border-box;
						-webkit-box-sizing:border-box;
						-ms-box-sizing:border-box;
						-moz-box-sizing:border-box;
						-o-box-sizing:border-box;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						animation:clockLoadingmin 1s linear 500;
						-webkit-animation:clockLoadingmin 1s linear 500;
						-ms-animation:clockLoadingmin 1s linear 500;
						-moz-animation:clockLoadingmin 1s linear 500;
						-o-animation:clockLoadingmin 1s linear 500;
					}
					.loader_Navigation1
					{
						width:100%;
						height:100%;
						animation:clockLoading 1s linear 500;
						-webkit-animation:clockLoading 1s linear 500;
						-ms-animation:clockLoading 1s linear 500;
						-moz-animation:clockLoading 1s linear 500;
						-o-animation:clockLoading 1s linear 500;
					}
					.loader_Navigation2
					{
						width:80%;
						height:80%;
						animation:anticlockLoading 1s linear 500;
						-webkit-animation:anticlockLoading 1s linear 500;
						-ms-animation:anticlockLoading 1s linear 500;
						-moz-animation:anticlockLoading 1s linear 500;
						-o-animation:anticlockLoading 1s linear 500;
					}
					@keyframes clockLoading
					{
						from{transform:rotate(0deg);-webkit-transform:-webkit-rotate(0deg);-ms-transform:rotate(0deg);-moz-transform:rotate(0deg);-o-transform:rotate(0deg);}
						to{transform:rotate(360deg);-webkit-transform:-webkit-rotate(360deg);-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-o-transform:rotate(360deg);}
					}
					@keyframes anticlockLoading
					{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(-360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(-360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(-360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(-360deg);}
					}
					@keyframes clockLoadingmin
					{
						from{transform:translateY(-50%) translateX(-50%) rotate(0deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(0deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);}
						to{transform:translateY(-50%) translateX(-50%) rotate(360deg);-webkit-transform:-webkit-translateY(-50%) -webkit-translateX(-50%) -webkit-rotate(360deg);-ms-transform:translateY(-50%) translateX(-50%) rotate(360deg);-moz-transform:translateY(-50%) translateX(-50%) rotate(360deg);-o-transform:translateY(-50%) translateX(-50%) rotate(360deg);}
					}
					/*Second Loader*/
					.overlay-loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> { display: block; margin: auto; width: 97px; height: 60px; position: relative; top: 0; left: 0; right: 0; bottom: 0; }
					<?php if($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_S == "small") { ?>
						.overlay-loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> { height: 40px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> { width: 49px !important; height: 49px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(2) { width: 3px !important; height: 3px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(3) { width: 9px !important; height: 9px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(4) { width: 14px !important; height: 14px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(5) { width: 19px !important; height: 19px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(6) { width: 24px !important; height: 24px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(7) { width: 28px !important; height: 28px !important; }
					<?php } elseif($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_S == "middle") { ?>
						.overlay-loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> { height: 50px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> { width: 67px !important; height: 67px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(2) { width: 8px !important; height: 8px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(3) { width: 14px !important; height: 14px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(4) { width: 20px !important; height: 20px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(5) { width: 26px !important; height: 26px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(6) { width: 32px !important; height: 32px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(7) { width: 38px !important; height: 38px !important; }
					<?php } else { ?>
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> { width: 97px !important; height: 97px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(2) { width: 12px !important; height: 12px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(3) { width: 18px !important; height: 18px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(4) { width: 23px !important; height: 23px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(5) { width: 31px !important; height: 31px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(6) { width: 39px !important; height: 39px !important; }
						.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(7) { width: 49px !important; height: 49px !important; }
					<?php } ?>
					.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						position: absolute;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
						width: 97px;
						height: 97px;
						animation-name: rotateAnim;
						-o-animation-name: rotateAnim;
						-ms-animation-name: rotateAnim;
						-webkit-animation-name: rotateAnim;
						-moz-animation-name: rotateAnim;
						animation-duration: 0.4s;
						-o-animation-duration: 0.4s;
						-ms-animation-duration: 0.4s;
						-webkit-animation-duration: 0.4s;
						-moz-animation-duration: 0.4s;
						animation-iteration-count: infinite;
						-o-animation-iteration-count: infinite;
						-ms-animation-iteration-count: infinite;
						-webkit-animation-iteration-count: infinite;
						-moz-animation-iteration-count: infinite;
						animation-timing-function: linear;
						-o-animation-timing-function: linear;
						-ms-animation-timing-function: linear;
						-webkit-animation-timing-function: linear;
						-moz-animation-timing-function: linear;
					}
					.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div
					{
						width: 8px;
						height: 8px;
						border-radius: 50%;
						border: 1px solid <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_C); ?>;
						position: absolute;
						top: 2px;
						left: 0;
						right: 0;
						bottom: 0;
						margin: auto;
					}
					.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(odd) { border-top: none; border-left: none; }
					.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(even) { border-bottom: none; border-right: none; }
					.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(2) { border-width: 2px; left: 0px; top: -4px; width: 12px; height: 12px; }
					.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(3) { border-width: 2px; left: -1px; top: 3px; width: 18px; height: 18px; }
					.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(4) { border-width: 3px; left: -1px; top: -4px; width: 23px; height: 23px; }
					.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(5) { border-width: 3px; left: -1px; top: 4px; width: 31px; height: 31px; }
					.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(6) { border-width: 4px; left: 0px; top: -4px; width: 39px; height: 39px; }
					.loader<?php echo esc_html($Rich_Web_VSlider_ID); ?> div:nth-child(7) { border-width: 4px; left: 0px; top: 6px; width: 49px; height: 49px; }
					@keyframes rotateAnim { from { transform: rotate(360deg); } to { transform: rotate(0deg); } }
					@-o-keyframes rotateAnim { from { -o-transform: rotate(360deg); } to { -o-transform: rotate(0deg); } }
					@-ms-keyframes rotateAnim { from { -ms-transform: rotate(360deg); } to { -ms-transform: rotate(0deg); } }
					@-webkit-keyframes rotateAnim { from { -webkit-transform: rotate(360deg); } to { -webkit-transform: rotate(0deg); } }
					@-moz-keyframes rotateAnim { from { -moz-transform: rotate(360deg); } to { -moz-transform: rotate(0deg); } }
					/*Third Loader*/
					<?php if($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_S == "small") { ?>
						.windows8<?php echo esc_html($Rich_Web_VSlider_ID); ?> { width: 45px !important; height:45px !important; }
						.windows8<?php echo esc_html($Rich_Web_VSlider_ID); ?> .wBall { width: 42px !important; height: 42px !important; }
					<?php } elseif($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_S == "middle") { ?>
						.windows8<?php echo esc_html($Rich_Web_VSlider_ID); ?> { width: 60px !important; height:60px !important; }
						.windows8<?php echo esc_html($Rich_Web_VSlider_ID); ?> .wBall { width: 56px !important; height: 56px !important; }
					<?php } else { ?>
						.windows8<?php echo esc_html($Rich_Web_VSlider_ID); ?> { width: 78px !important; height:78px !important; }
						.windows8<?php echo esc_html($Rich_Web_VSlider_ID); ?> .wBall { width: 74px !important; height: 74px !important; }
					<?php } ?>
					.windows8<?php echo esc_html($Rich_Web_VSlider_ID); ?> { position: relative; width: 78px; height:78px; margin:auto; }
					.windows8<?php echo esc_html($Rich_Web_VSlider_ID); ?> .wBall
					{
						position: absolute;
						width: 74px;
						height: 74px;
						opacity: 0;
						transform: rotate(225deg);
						-o-transform: rotate(225deg);
						-ms-transform: rotate(225deg);
						-webkit-transform: rotate(225deg);
						-moz-transform: rotate(225deg);
						animation: orbit 6.96s infinite;
						-o-animation: orbit 6.96s infinite;
						-ms-animation: orbit 6.96s infinite;
						-webkit-animation: orbit 6.96s infinite;
						-moz-animation: orbit 6.96s infinite;
					}
					.windows8<?php echo esc_html($Rich_Web_VSlider_ID); ?> .wBall .wInnerBall
					{
						position: absolute;
						width: 10px;
						height: 10px;
						background: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_C); ?>;
						left:0px;
						top:0px;
						border-radius: 10px;
					}
					.windows8<?php echo esc_html($Rich_Web_VSlider_ID); ?> #wBall_1
					{
						animation-delay: 1.52s;
						-o-animation-delay: 1.52s;
						-ms-animation-delay: 1.52s;
						-webkit-animation-delay: 1.52s;
						-moz-animation-delay: 1.52s;
					}
					.windows8<?php echo esc_html($Rich_Web_VSlider_ID); ?> #wBall_2
					{
						animation-delay: 0.3s;
						-o-animation-delay: 0.3s;
						-ms-animation-delay: 0.3s;
						-webkit-animation-delay: 0.3s;
						-moz-animation-delay: 0.3s;
					}
					.windows8<?php echo esc_html($Rich_Web_VSlider_ID); ?> #wBall_3
					{
						animation-delay: 0.61s;
						-o-animation-delay: 0.61s;
						-ms-animation-delay: 0.61s;
						-webkit-animation-delay: 0.61s;
						-moz-animation-delay: 0.61s;
					}
					.windows8<?php echo esc_html($Rich_Web_VSlider_ID); ?> #wBall_4
					{
						animation-delay: 0.91s;
						-o-animation-delay: 0.91s;
						-ms-animation-delay: 0.91s;
						-webkit-animation-delay: 0.91s;
						-moz-animation-delay: 0.91s;
					}
					.windows8<?php echo esc_html($Rich_Web_VSlider_ID); ?> #wBall_5
					{
						animation-delay: 1.22s;
						-o-animation-delay: 1.22s;
						-ms-animation-delay: 1.22s;
						-webkit-animation-delay: 1.22s;
						-moz-animation-delay: 1.22s;
					}
					@keyframes orbit
					{
						0% { opacity: 1; z-index:99; transform: rotate(180deg); animation-timing-function: ease-out; }
						7% { opacity: 1; transform: rotate(300deg); animation-timing-function: linear; transform-origin:0%; }
						30% { opacity: 1; transform: rotate(410deg); animation-timing-function: ease-in-out; transform-origin:7%; }
						39% { opacity: 1; transform: rotate(645deg); animation-timing-function: linear; transform-origin:30%; }
						70% { opacity: 1; transform: rotate(770deg); animation-timing-function: ease-out; transform-origin:39%; }
						75% { opacity: 1; transform: rotate(900deg); animation-timing-function: ease-out; transform-origin:70%; }
						76% { opacity: 0; transform: rotate(900deg); }
						100% { opacity: 0; transform: rotate(900deg); }
					}
					@-o-keyframes orbit
					{
						0% { opacity: 1; z-index:99; -o-transform: rotate(180deg); -o-animation-timing-function: ease-out; }
						7% { opacity: 1; -o-transform: rotate(300deg); -o-animation-timing-function: linear; -o-transform-origin:0%; }
						30% { opacity: 1; -o-transform: rotate(410deg); -o-animation-timing-function: ease-in-out; -o-transform-origin:7%; }
						39% { opacity: 1; -o-transform: rotate(645deg); -o-animation-timing-function: linear; -o-transform-origin:30%; }
						70% { opacity: 1; -o-transform: rotate(770deg); -o-animation-timing-function: ease-out; -o-transform-origin:39%; }
						75% { opacity: 1; -o-transform: rotate(900deg); -o-animation-timing-function: ease-out; -o-transform-origin:70%; }
						76% { opacity: 0; -o-transform: rotate(900deg); }
						100% { opacity: 0; -o-transform: rotate(900deg); }
					}
					@-ms-keyframes orbit
					{
						0% { opacity: 1; z-index:99; -ms-transform: rotate(180deg); -ms-animation-timing-function: ease-out; }
						7% { opacity: 1; -ms-transform: rotate(300deg); -ms-animation-timing-function: linear; -ms-transform-origin:0%; }
						30% { opacity: 1; -ms-transform: rotate(410deg); -ms-animation-timing-function: ease-in-out; -ms-transform-origin:7%; }
						39% { opacity: 1; -ms-transform: rotate(645deg); -ms-animation-timing-function: linear; -ms-transform-origin:30%; }
						70% { opacity: 1; -ms-transform: rotate(770deg); -ms-animation-timing-function: ease-out; -ms-transform-origin:39%; }
						75% { opacity: 1; -ms-transform: rotate(900deg); -ms-animation-timing-function: ease-out; -ms-transform-origin:70%; }
						76% { opacity: 0; -ms-transform: rotate(900deg); }
						100% { opacity: 0; -ms-transform: rotate(900deg); }
					}
					@-webkit-keyframes orbit
					{
						0% { opacity: 1; z-index:99; -webkit-transform: rotate(180deg); -webkit-animation-timing-function: ease-out; }
						7% { opacity: 1; -webkit-transform: rotate(300deg); -webkit-animation-timing-function: linear; -webkit-transform-origin:0%; }
						30% { opacity: 1; -webkit-transform: rotate(410deg); -webkit-animation-timing-function: ease-in-out; -webkit-transform-origin:7%; }
						39% { opacity: 1; -webkit-transform: rotate(645deg); -webkit-animation-timing-function: linear; -webkit-transform-origin:30%; }
						70% { opacity: 1; -webkit-transform: rotate(770deg); -webkit-animation-timing-function: ease-out; -webkit-transform-origin:39%; }
						75% { opacity: 1; -webkit-transform: rotate(900deg); -webkit-animation-timing-function: ease-out; -webkit-transform-origin:70%; }
						76% { opacity: 0; -webkit-transform: rotate(900deg); }
						100% { opacity: 0; -webkit-transform: rotate(900deg); }
					}
					@-moz-keyframes orbit
					{
						0% { opacity: 1; z-index:99; -moz-transform: rotate(180deg); -moz-animation-timing-function: ease-out; }
						7% { opacity: 1; -moz-transform: rotate(300deg); -moz-animation-timing-function: linear; -moz-transform-origin:0%; }
						30% { opacity: 1; -moz-transform: rotate(410deg); -moz-animation-timing-function: ease-in-out; -moz-transform-origin:7%; }
						39% { opacity: 1; -moz-transform: rotate(645deg); -moz-animation-timing-function: linear; -moz-transform-origin:30%; }
						70% { opacity: 1; -moz-transform: rotate(770deg); -moz-animation-timing-function: ease-out; -moz-transform-origin:39%; }
						75% { opacity: 1; -moz-transform: rotate(900deg); -moz-animation-timing-function: ease-out; -moz-transform-origin:70%; }
						76% { opacity: 0; -moz-transform: rotate(900deg); }
						100% { opacity: 0; -moz-transform: rotate(900deg); }
					}
					/*Fourth loader*/
					<?php if($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_S == "small") { ?>
						.cssload-thecube<?php echo esc_html($Rich_Web_VSlider_ID); ?> { width: 30px !important; height: 30px !important; }
					<?php } elseif($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_S == "middle") { ?>
						.cssload-thecube<?php echo esc_html($Rich_Web_VSlider_ID); ?> { width: 40px !important; height: 40px !important; }
					<?php } else { ?>
						.cssload-thecube<?php echo esc_html($Rich_Web_VSlider_ID); ?> { width: 50px !important; height: 50px !important; }
					<?php } ?>
					.cssload-thecube<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						width: 50px;
						height: 50px;
						margin: 20px auto;
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo esc_html($Rich_Web_VSlider_ID); ?> .cssload-cube
					{
						position: relative;
						transform: rotateZ(45deg);
						-o-transform: rotateZ(45deg);
						-ms-transform: rotateZ(45deg);
						-webkit-transform: rotateZ(45deg);
						-moz-transform: rotateZ(45deg);
					}
					.cssload-thecube<?php echo esc_html($Rich_Web_VSlider_ID); ?> .cssload-cube
					{
						float: left;
						width: 50%;
						height: 50%;
						position: relative;
						transform: scale(1.1);
						-o-transform: scale(1.1);
						-ms-transform: scale(1.1);
						-webkit-transform: scale(1.1);
						-moz-transform: scale(1.1);
					}
					.cssload-thecube<?php echo esc_html($Rich_Web_VSlider_ID); ?> .cssload-cube:before
					{
						content: "";
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						background-color: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_L_C); ?>;
						animation: cssload-fold-thecube 2.76s infinite linear both;
						-o-animation: cssload-fold-thecube 2.76s infinite linear both;
						-ms-animation: cssload-fold-thecube 2.76s infinite linear both;
						-webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
						-moz-animation: cssload-fold-thecube 2.76s infinite linear both;
						transform-origin: 100% 100%;
						-o-transform-origin: 100% 100%;
						-ms-transform-origin: 100% 100%;
						-webkit-transform-origin: 100% 100%;
						-moz-transform-origin: 100% 100%;
					}
					.cssload-thecube<?php echo esc_html($Rich_Web_VSlider_ID); ?> .cssload-c2
					{
						transform: scale(1.1) rotateZ(90deg);
						-o-transform: scale(1.1) rotateZ(90deg);
						-ms-transform: scale(1.1) rotateZ(90deg);
						-webkit-transform: scale(1.1) rotateZ(90deg);
						-moz-transform: scale(1.1) rotateZ(90deg);
					}
					.cssload-thecube<?php echo esc_html($Rich_Web_VSlider_ID); ?> .cssload-c3
					{
						transform: scale(1.1) rotateZ(180deg);
						-o-transform: scale(1.1) rotateZ(180deg);
						-ms-transform: scale(1.1) rotateZ(180deg);
						-webkit-transform: scale(1.1) rotateZ(180deg);
						-moz-transform: scale(1.1) rotateZ(180deg);
					}
					.cssload-thecube<?php echo esc_html($Rich_Web_VSlider_ID); ?> .cssload-c4
					{
						transform: scale(1.1) rotateZ(270deg);
						-o-transform: scale(1.1) rotateZ(270deg);
						-ms-transform: scale(1.1) rotateZ(270deg);
						-webkit-transform: scale(1.1) rotateZ(270deg);
						-moz-transform: scale(1.1) rotateZ(270deg);
					}
					.cssload-thecube<?php echo esc_html($Rich_Web_VSlider_ID); ?> .cssload-c2:before
					{
						animation-delay: 0.35s;
						-o-animation-delay: 0.35s;
						-ms-animation-delay: 0.35s;
						-webkit-animation-delay: 0.35s;
						-moz-animation-delay: 0.35s;
					}
					.cssload-thecube<?php echo esc_html($Rich_Web_VSlider_ID); ?> .cssload-c3:before
					{
						animation-delay: 0.69s;
						-o-animation-delay: 0.69s;
						-ms-animation-delay: 0.69s;
						-webkit-animation-delay: 0.69s;
						-moz-animation-delay: 0.69s;
					}
					.cssload-thecube<?php echo esc_html($Rich_Web_VSlider_ID); ?> .cssload-c4:before
					{
						animation-delay: 1.04s;
						-o-animation-delay: 1.04s;
						-ms-animation-delay: 1.04s;
						-webkit-animation-delay: 1.04s;
						-moz-animation-delay: 1.04s;
					}
					@keyframes cssload-fold-thecube
					{
						0%, 10% { transform: perspective(136px) rotateX(-180deg); opacity: 0; }
						25%, 75% { transform: perspective(136px) rotateX(0deg); opacity: 1; }
						90%, 100% { transform: perspective(136px) rotateY(180deg); opacity: 0; }
					}
					@-o-keyframes cssload-fold-thecube
					{
						0%, 10% { -o-transform: perspective(136px) rotateX(-180deg); opacity: 0; }
						25%, 75% { -o-transform: perspective(136px) rotateX(0deg); opacity: 1; }
						90%, 100% { -o-transform: perspective(136px) rotateY(180deg); opacity: 0; }
					}
					@-ms-keyframes cssload-fold-thecube
					{
						0%, 10% { -ms-transform: perspective(136px) rotateX(-180deg); opacity: 0; }
						25%, 75% { -ms-transform: perspective(136px) rotateX(0deg); opacity: 1; }
						90%, 100% { -ms-transform: perspective(136px) rotateY(180deg); opacity: 0; }
					}
					@-webkit-keyframes cssload-fold-thecube
					{
						0%, 10% { -webkit-transform: perspective(136px) rotateX(-180deg); opacity: 0; }
						25%, 75% { -webkit-transform: perspective(136px) rotateX(0deg); opacity: 1; }
						90%, 100% { -webkit-transform: perspective(136px) rotateY(180deg); opacity: 0; }
					}
					@-moz-keyframes cssload-fold-thecube
					{
						0%, 10% { -moz-transform: perspective(136px) rotateX(-180deg); opacity: 0; }
						25%, 75% { -moz-transform: perspective(136px) rotateX(0deg); opacity: 1; }
						90%, 100% { -moz-transform: perspective(136px) rotateY(180deg); opacity: 0; }
					}
					/*First Text*/
					.cssload-loader<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						width: 244px;
						height: 49px;
						line-height: 49px;
						text-align: center;
						position: relative;
						left: 50%;
						transform: translate(-50%, 0%);
						-o-transform: translate(-50%, 0%);
						-ms-transform: translate(-50%, 0%);
						-webkit-transform: translate(-50%, 0%);
						-moz-transform: translate(-50%, 0%);
						font-family: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_FF); ?> !important;
						text-transform: none !important;
						font-weight: 900;
						font-size:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_FS); ?>px !important;
						color: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_C); ?> !important;
						letter-spacing: 0.2em;
						margin-top:10px;
					}
					.cssload-loader<?php echo esc_html($Rich_Web_VSlider_ID); ?>::before, .cssload-loader<?php echo esc_html($Rich_Web_VSlider_ID); ?>::after
					{
						content: "";
						display: block;
						width: 15px;
						height: 15px;
						background: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T2_BC); ?> !important;
						position: absolute;
						animation: cssload-load 0.81s infinite alternate ease-in-out;
						-o-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
						-moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
					}
					.cssload-loader<?php echo esc_html($Rich_Web_VSlider_ID); ?>::before { top: 0; }
					.cssload-loader<?php echo esc_html($Rich_Web_VSlider_ID); ?>::after { bottom: 0; }
					@keyframes cssload-load { 0% { left: 0; height: 29px; width: 15px; } 50% { height: 8px; width: 39px; } 100% { left: 229px; height: 29px; width: 15px; } }
					@-o-keyframes cssload-load { 0% { left: 0; height: 29px; width: 15px; } 50% { height: 8px; width: 39px; } 100% { left: 229px; height: 29px; width: 15px; } }
					@-ms-keyframes cssload-load { 0% { left: 0; height: 29px; width: 15px; } 50% { height: 8px; width: 39px; } 100% { left: 229px; height: 29px; width: 15px; } }
					@-moz-keyframes cssload-load { 0% { left: 0; height: 29px; width: 15px; } 50% { height: 8px; width: 39px; } 100% { left: 229px; height: 29px; width: 15px; } }
					@-webkit-keyframes cssload-load { 0% { left: 0; height: 29px; width: 15px; } 50% { height: 8px; width: 39px; } 100% { left: 229px; height: 29px; width: 15px; } }
					/*Second*/
					#inTurnFadingTextG<?php echo esc_html($Rich_Web_VSlider_ID); ?> { width:100%; margin:auto; text-align:center; }
					.inTurnFadingTextG<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						font-size: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_FS); ?>px !important;
						font-family:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_FF); ?> !important;
						color: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_C); ?> !important;
						text-decoration:none;
						font-weight:normal;
						font-style:normal;
						display:inline-block;
						animation-name:bounce_inTurnFadingTextG;
						-o-animation-name:bounce_inTurnFadingTextG;
						-ms-animation-name:bounce_inTurnFadingTextG;
						-webkit-animation-name:bounce_inTurnFadingTextG;
						-moz-animation-name:bounce_inTurnFadingTextG;
						animation-duration:2.09s;
						-o-animation-duration:2.09s;
						-ms-animation-duration:2.09s;
						-webkit-animation-duration:2.09s;
						-moz-animation-duration:2.09s;
						animation-iteration-count:infinite;
						-o-animation-iteration-count:infinite;
						-ms-animation-iteration-count:infinite;
						-webkit-animation-iteration-count:infinite;
						-moz-animation-iteration-count:infinite;
						animation-direction:normal;
						-o-animation-direction:normal;
						-ms-animation-direction:normal;
						-webkit-animation-direction:normal;
						-moz-animation-direction:normal;
					}
					<?php foreach($text_array as $key=>$v) { ?>
						#inTurnFadingTextG<?php echo esc_html($Rich_Web_VSlider_ID); ?>_<?php echo esc_attr($key + 1); ?>
						{
							animation-delay:<?php echo esc_attr($anim_sum); ?>s !important;
							-o-animation-delay:<?php echo esc_attr($anim_sum); ?>s !important;
							-ms-animation-delay:<?php echo esc_attr($anim_sum); ?>s !important;
							-webkit-animation-delay:<?php echo esc_attr($anim_sum); ?>s !important;
							-moz-animation-delay:<?php echo esc_attr($anim_sum); ?>s !important;
						}
						<?php $anim_sum=$anim_sum+0.15; ?>
					<?php } ?>
					@keyframes bounce_inTurnFadingTextG
					{
						0% { color:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T2_AnC); ?>; }
						100% { color:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_C); ?> !important; }
					}
					@-o-keyframes bounce_inTurnFadingTextG
					{
						0% { color:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T2_AnC); ?>; }
						100% { color:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_C); ?> !important; }
					}
					@-ms-keyframes bounce_inTurnFadingTextG
					{
						0% { color:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T2_AnC); ?>; }
						100% { color:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_C); ?> !important; }
					}
					@-webkit-keyframes bounce_inTurnFadingTextG
					{
						0% { color:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T2_AnC); ?>; }
						100% { color:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_C); ?> !important; }
					}
					@-moz-keyframes bounce_inTurnFadingTextG
					{
						0% { color:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T2_AnC); ?>; }
						100% { color:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_C); ?> !important; }
					}
					/*Third text*/
					.cssload-preloader<?php echo esc_html($Rich_Web_VSlider_ID); ?> { position: relative; top: 0px; left: 0px; right: 0px; bottom: 0px; z-index: 10; }
					.cssload-preloader<?php echo esc_html($Rich_Web_VSlider_ID); ?> > .cssload-preloader<?php echo esc_html($Rich_Web_VSlider_ID); ?>-box
					{
						position: relative;
						display:inline-block;
						margin-left:10px;
						margin-top:20px;
						height: 29px;
						left:50%;
						transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-o-transform:translateX(-50%) !important;
						perspective: 195px;
						-o-perspective: 195px;
						-ms-perspective: 195px;
						-webkit-perspective: 195px;
						-moz-perspective: 195px;
					}
					.cssload-preloader<?php echo esc_html($Rich_Web_VSlider_ID); ?> .cssload-preloader<?php echo esc_html($Rich_Web_VSlider_ID); ?>-box > div
					{
						position: relative;
						width: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_FS*2); ?>px;
						height: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_FS*2); ?>px;
						background: rgb(204,204,204);
						float: left;
						text-align: center;
						line-height: 2;
						font-size: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_FS); ?>px !important;
						font-family:<?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_FF); ?> !important;
						color: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_C); ?> !important;
					}
					<?php foreach($text_array as $key=>$v) { ?>
						.cssload-preloader<?php echo esc_html($Rich_Web_VSlider_ID); ?> .cssload-preloader<?php echo esc_html($Rich_Web_VSlider_ID); ?>-box > div:nth-child(<?php echo esc_attr($key + 1); ?>)
						{
							background: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T3_BgC); ?> !important;
							margin-right: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_FS); ?>px !important;
							animation: cssload-movement<?php echo esc_html($Rich_Web_VSlider_ID); ?> 690ms ease <?php echo esc_attr($str_sum); ?>ms infinite alternate;
							-o-animation: cssload-movement<?php echo esc_html($Rich_Web_VSlider_ID); ?> 690ms ease <?php echo esc_attr($str_sum); ?>ms infinite alternate;
							-ms-animation: cssload-movement<?php echo esc_html($Rich_Web_VSlider_ID); ?> 690ms ease <?php echo esc_attr($str_sum); ?>ms infinite alternate;
							-webkit-animation: cssload-movement<?php echo esc_html($Rich_Web_VSlider_ID); ?> 690ms ease <?php echo esc_attr($str_sum); ?>ms infinite alternate;
							-moz-animation: cssload-movement<?php echo esc_html($Rich_Web_VSlider_ID); ?> 690ms ease <?php echo esc_attr($str_sum); ?>ms infinite alternate;
						}
						<?php $str_sum=$str_sum+86.25; ?>
					<?php } ?>
					@keyframes cssload-movement<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						from { transform: scale(1.0) translateY(0px) rotateX(0deg); box-shadow: 0 0 0 rgba(0,0,0,0); }
						to {
							transform: scale(1.5) translateY(-24px) rotateX(45deg);
							box-shadow: 0 24px 39px <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T3_BgC); ?>;
							background: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T3_BgC); ?> !important;
						}
					}
					@-o-keyframes cssload-movement<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						from { -o-transform: scale(1.0) translateY(0px) rotateX(0deg); -o-box-shadow: 0 0 0 rgba(0,0,0,0); }
						to {
							-o-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							-o-box-shadow: 0 24px 39px <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T3_BgC); ?>;
							background: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T3_BgC); ?> !important;
						}
					}
					@-ms-keyframes cssload-movement<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						from { -ms-transform: scale(1.0) translateY(0px) rotateX(0deg); -ms-box-shadow: 0 0 0 rgba(0,0,0,0); }
						to {
							-ms-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							-ms-box-shadow: 0 24px 39px <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T3_BgC); ?>;
							background: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T3_BgC); ?> !important;
						}
					}
					@-webkit-keyframes cssload-movement<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						from { -webkit-transform: scale(1.0) translateY(0px) rotateX(0deg); -webkit-box-shadow: 0 0 0 rgba(0,0,0,0); }
						to {
							-webkit-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							-webkit-box-shadow: 0 24px 39px <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T3_BgC); ?>;
							background: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T3_BgC); ?> !important;
						}
					}
					@-moz-keyframes cssload-movement<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						from { -moz-transform: scale(1.0) translateY(0px) rotateX(0deg); -moz-box-shadow: 0 0 0 rgba(0,0,0,0); }
						to {
							-moz-transform: scale(1.5) translateY(-24px) rotateX(45deg);
							-moz-box-shadow: 0 24px 39px <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T3_BgC); ?>;
							background: <?php echo esc_attr($Rich_Web_VSlider_Eff_Loader[0]->Rich_Web_RichSl_LT_T3_BgC); ?> !important;
						}
					}
					.rvs-container<?php echo esc_html($Rich_Web_VSlider_ID); ?> { position:relative; margin-bottom:50px !important; max-width:100%; }
					.rvs-container<?php echo esc_html($Rich_Web_VSlider_ID); ?>_mobile { height:auto !important; }
					.rvs-item-stage<?php echo esc_html($Rich_Web_VSlider_ID); ?> { height:100% !important; }
					.rvs-item-stage<?php echo esc_html($Rich_Web_VSlider_ID); ?>_mobile { padding-bottom:56.25%; }
					<?php if($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_ShT == "Type 1") {?>
						.rvs-container<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							box-shadow:0px 0px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_Sh); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_ShC); ?> !important;
							-moz-box-shadow:0px 0px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_Sh); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_ShC); ?> !important;
							-webkit-box-shadow:0px 0px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_Sh); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_ShC); ?> !important;
						}
					<?php } else { ?>
						.rvs-container<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							box-shadow:0px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_Sh/2); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_Sh); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_ShC); ?> !important;
							-moz-box-shadow:0px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_Sh/2); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_Sh); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_ShC); ?> !important;
							-webkit-box-shadow:0px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_Sh/2); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_Sh); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_ShC); ?> !important;
						}
					<?php } ?>
					.rvs-nav-container<?php echo esc_html($Rich_Web_VSlider_ID); ?> a.rvs-nav-item
					{
						border-top:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NI_BW); ?>px solid <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NI_BC); ?> !important;
					}
					.rvs-nav-container<?php echo esc_html($Rich_Web_VSlider_ID); ?> a.rvs-nav-item:hover
					{
						background-color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NI_HBgC); ?> !important;
						border-color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NI_HBC); ?> !important;
					}
					.rvs-nav-container<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						background-color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NI_BgC); ?> !important;
					}
					.rvs-container<?php echo esc_html($Rich_Web_VSlider_ID); ?> a.rvs-nav-item.rvs-active
					{
						background-color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NI_CBgC); ?> !important;
						border-color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NI_CBC); ?> !important;
					}
					.rvs-nav-item-title<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						font-size: <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NT_FS); ?>px !important;
						font-family:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NT_FF); ?> !important;
						color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NT_C); ?> !important;
						line-height:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NT_FS+3); ?>px !important;
						text-transform:none !important;
						letter-spacing: 0 !important;
					}
					.rvs-nav-item:hover .rvs-nav-item-title<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NT_HC); ?> !important;
					}
					.rvs-active .rvs-nav-item-title<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NT_CC); ?> !important;
					}
					.rvs-nav-item-thumb<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						border:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_BW); ?>px solid <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NScroll_HBgC); ?> !important;
						border-radius:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_BR); ?>% !important;
					}
					<?php if($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_ShT == "Type 1") {?>
						.rvs-nav-item-thumb<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							box-shadow:0px 0px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_BSh); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_ShC); ?> !important;
							-moz-box-shadow:0px 0px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_BSh); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_ShC); ?> !important;
							-webkit-box-shadow:0px 0px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_BSh); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_ShC); ?> !important;
						}
					<?php } else { ?>
						.rvs-nav-item-thumb<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							box-shadow:0px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_BSh/2); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_BSh); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_ShC); ?> !important;
							-moz-box-shadow:0px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_BSh/2); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_BSh); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_ShC); ?> !important;
							-webkit-box-shadow:0px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_BSh/2); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_BSh); ?>px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NImg_ShC); ?> !important;
						}
					<?php } ?>
					.rvs-nav-prev<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						background:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NScroll_BgC); ?> !important;
						border-color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NScroll_BgC); ?> !important;
						color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NScroll_C); ?> !important;
					}
					.rvs-nav-next<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						background:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NScroll_BgC); ?> !important;
						border-color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NScroll_BgC); ?> !important;
						color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NScroll_C); ?> !important;
					}
					.rvs-item-text<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						font-size:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_IT_FS); ?>px !important;
						font-family:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_IT_FF); ?> !important;
						color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_IT_C); ?> !important;
					}
					.rvs-item-text<?php echo esc_html($Rich_Web_VSlider_ID); ?> p
					{
						line-height: 1 !important;
						margin: 0 !important;
						padding: 0 !important;
					}
					.rvs-play-video<?php echo esc_html($Rich_Web_VSlider_ID); ?>:before
					{
						font-size:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_PlIc_FS); ?>px !important;
						color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_PlIc_C); ?> !important;
						top:0% !important;
						transform:none !important;
						-webkit-transform:none !important;
						-ms-transform:none !important;
						-moz-transform:none !important;
						-o-transform:none !important;
					}
					.rvs-play-video<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						width:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_PlIc_FS*2); ?>px !important;
						height:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_PlIc_FS*2); ?>px !important;
						line-height:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_PlIc_FS*2); ?>px !important;
					}
					.rvs-play-video<?php echo esc_html($Rich_Web_VSlider_ID); ?>
					{
						background-color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_PlIc_BgC); ?> !important;
					}
					.rvs-play-video<?php echo esc_html($Rich_Web_VSlider_ID); ?>:hover
					{
						background-color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_PlIc_HBgC); ?> !important;
					}
					.rw_rvs-close
					{
						position: absolute;
						color:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_DelIc_C); ?> !important;
						font-size:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_DelIc_FS); ?>px !important;
						top: 10px;
						left: 10px;
						padding: 5px 7px;
						background: <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_DelIc_BgC); ?> !important;
						cursor: pointer;
						border-radius: 4px;
						text-decoration: none !important;
					}
					.rw_rvs-close:hover
					{
						background: <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_DelIc_HBgC); ?> !important;
						text-decoration: none;
					}
					.rvs-nav-container<?php echo esc_html($Rich_Web_VSlider_ID); ?>::-webkit-scrollbar { width: 0.5em; }
					.rvs-nav-container<?php echo esc_html($Rich_Web_VSlider_ID); ?>::-webkit-scrollbar-track
					{
						-webkit-box-shadow: inset 0 0 6px <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NI_BgC); ?>;
					}
					.rvs-nav-container<?php echo esc_html($Rich_Web_VSlider_ID); ?>::-webkit-scrollbar-thumb
					{
						background-color: <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NT_C); ?>;
						outline: <?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_NT_C); ?>;
					}
					.rvs-nav-item { border-bottom:none !important; box-shadow:none !important; -moz-box-shadow:none !important; -webkit-box-shadow:none !important; }
					@media screen and (max-width:500px)
					{
						.rvs-play-video<?php echo esc_html($Rich_Web_VSlider_ID); ?>:before{ font-size:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_PlIc_FS/2); ?>px !important; }
						.rvs-play-video<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							width:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_PlIc_FS); ?>px !important;
							height:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_PlIc_FS); ?>px !important;
							line-height:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_PlIc_FS/2+2); ?>px !important;
						}
						.rvs-item-text<?php echo esc_html($Rich_Web_VSlider_ID); ?>
						{
							font-size:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_IT_FS*2/3); ?>px !important;
							line-height:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_IT_FS*2/3+3); ?>px !important;
						}
						.rw_rvs-close
						{
							font-size:<?php echo esc_attr($Rich_Web_VSlider_Eff[0]->Rich_Web_RVVS_DelIc_FS*2/3); ?>px !important;
							padding: 3px 5px;
						}
					}
				</style>