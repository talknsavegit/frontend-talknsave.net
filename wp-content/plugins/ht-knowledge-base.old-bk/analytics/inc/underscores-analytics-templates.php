<!-- Feedback Card Template -->
<script type="text/html" id="ht-analytics-card-template">

        <div class="hkba-panel hkb-feedbackcard hkb-feedbackcard--<%= feedback.rating %>">

            <header class="hkb-feedbackcard__header">
                <a href="<%= feedback.articleEditUrl %>" class="hkb-feedbackcard__articletitle"><%= feedback.articleTitle %></a>
            </header>

            <div class="hkb-feedbackcard__content">
                <%= feedback.fullFeedback %>
            </div>    

            <footer class="hkb-feedbackcard__footer"> 
                <div class="hkb-feedbackcard__avatar">
                    <%= feedback.authorImg %>
                </div>
                <div class="hkb-feedbackcard__author">
                    <%= feedback.authorName %>
                </div> 
                <div class="hkb-feedbackcard__time">
                    <%= feedback.datetime %>
                </div>
            </footer>
        </div>

</script>

<script type="text/html" id="ht-analytics-card-nofeedback">

        <div class="hkba-nofeedback">
            <h3 class="hkba-nofeedback__title">
                <?php _e('No comments', 'ht-knowledge-base'); ?>
            </h3>

            <div class="hkba-nofeedback__content">
                    <?php _e('No one has left any comments for this period, please try selecting another date range.', 'ht-knowledge-base'); ?>
            </div>    
        </div>

</script>