<?php
if (have_rows('membership')) :
    if (get_post_type() === 'committees') {
        echo '<h3 class="membership__title">Committee Members</h3>'; // Output heading for custom post type "committee" with the class
    } elseif (get_post_type() === 'ministry') {
        echo '<h3 class="membership__title">Ministry Contacts</h3>'; // Output heading for custom post type "ministry" with the class
    }

    echo '<ul class="membership__list">'; // Add the class to the outer unordered list

    while (have_rows('membership')) :
        the_row();

        if (have_rows('committee_group')) :
            while (have_rows('committee_group')) :
                the_row();

                $committeeGroupName = get_sub_field('committee_group_name');

                if ($committeeGroupName) {
                    echo '<h4 class="membership__class">' . $committeeGroupName . '</h4>'; // Output the committee group name as an h4 tag with the class "membership__class"
                }

                if (have_rows('member_info')) :
                    echo '<ul class="membership__members">'; // Add the class to the inner unordered list

                    while (have_rows('member_info')) :
                        the_row();

                        $memberName = get_sub_field('member_name');
                        $memberTitle = get_sub_field('member_title');

                        // Output member name and title as a formatted string
                        echo '<li class="membership__member">';
                        echo '<span class="membership__name">' . $memberName;

                        if ($memberTitle) {
                            echo ', ' . $memberTitle;
                        }

                        echo '</span>';
                        echo '</li>';

                    endwhile;

                    echo '</ul>'; // End the inner unordered list
                endif;

            endwhile;
        endif;

    endwhile;

    echo '</ul>'; // End the outer unordered list

endif;
?>
