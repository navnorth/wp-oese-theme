( function( wp ) {

    var withSelect  = wp.data.withSelect;
    var ifCondition = wp.compose.ifCondition;
    var compose     = wp.compose.compose;


    var OESE_LinkToMedia = function( props ) {
       return wp.element.createElement(
            wp.editor.RichTextToolbarButton, {
                icon: 'admin-media', 
                title: 'Link to Media', 
                onClick: function() {
                    props.onChange( 
                        wp.richText.toggleFormat(props.value, {
                            type: 'oese/link-to-media'
                        }) 
                    );
                }
            }
        );
    }

    /** Only show link to media button on paragraph block **/
    var OESE_ConditionalLinkToMedia = compose(
        withSelect( function( select ) {
            return {
                selectedBlock: select( 'core/editor' ).getSelectedBlock()
            }
        } ),
        ifCondition( function( props ) {
            return (
                props.selectedBlock &&
                props.selectedBlock.name === 'core/paragraph'
            );
        } )
    )( OESE_LinkToMedia );

    wp.richText.registerFormatType(
        'oese/link-to-media', {
            title: 'Link To Media',
            tagName: 'a',
            attributes: {
                href: 'https://navigationnorth.com/'
            },
            className: 'oese-link-to-media',
            edit: OESE_LinkToMedia,
        }
    );
} )( window.wp );