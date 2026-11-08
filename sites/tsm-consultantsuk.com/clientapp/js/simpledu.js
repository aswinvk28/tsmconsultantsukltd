var TSM = TSM || {};

TSM.Globals = {
    rsingleTag : /^<(\w+)\s*\/?>(?:<\/\1>)?$/
};

window.JST = {};

function CarouselSlideButton(element) {
    element = element instanceof $ ? element : $(element);
    element.find(".icon-button").addClass("display");
    $(".icon-button").not(element.find(".icon-button")).removeClass("display");
}

JST['front/course-form'] = _.template('<form method="POST" class="tile-form" action="courses-info"><input type="hidden" name="course_name" value="<%= exam %>" /><input type="hidden" name="course_title" value="<%= course_title %>" /></form>');
JST['front/tile-form'] = _.template('<form method="POST" class="tile-form" action=""><input type="hidden" name="q" value="<%= path %>" /></form>');
JST['front/carousel-nav'] = _.template('<a href="#slider" class="carousel-nav btn-slider" onclick="<%= onclick %>"><i class="<%= ClassNames %>"></i></a>');

JST['courses/certifier'] = _.template('<h4 class="column-heading gray"><%= certifier %></h4><div class="tab-content-details"><%= certifier_details %></div><p>The list of courses that <%= certifier %> offer are:</p>');
JST['courses/certifier-link-row'] = _.template('<td class="first-item"><a class="course-info-link" onclick="<%= onclick %>"><%= course_title %></a><form method="POST" action="courses-info"><input type="hidden" name="course_name" value="<%= exam %>" /><input type="hidden" name="course_title" value="<%= course_title %>" /></form></td><td class="last-item"><%= tab_level %></td>');
JST['courses/tab-link'] = _.template('<a class="label label-info course-info-link" onclick="<%= onclick %>"><%= course_title %></a><form method="POST" action="courses-info"><input type="hidden" name="course_name" value="<%= exam %>" /><input type="hidden" name="course_title" value="<%= course_title %>" /></form>');
JST['courses/tab-content'] = _.template('<h4 class="column-heading gray"><%= tab %></h4><div class="tab-content-details"><%= tab_details %></div><p>The courses are distributed into sub-categories and levels under the <%= tab %> category as:</p>');
JST['courses/tab-list'] = _.template('<a href="<%= id %>"><i class="<%= ClassNames %>"></i><%= tab_name %></a>');

JST['contact/faq'] = _.template('<div class="accordion-group"><div class="accordion-heading"><a class="accordion-toggle" href="<%= reference %>" data-parent="<%= parentId %>" data-toggle="<%= collapsibleClassName %>"><%= question %></a></div><div class="accordion-body collapse" id="<%= bodyId %>"><div class="accordion-inner"><%= answer %></div></div></div>');

function setRouter() {
    var Theme = new TSM.Simpledu();
}

TSM.Essential = Backbone.Model.extend({ initialize: function() { this.essentials = window.LoadEssentials(); return this; } });
TSM.FAQ = Backbone.Model.extend({ initialize: function() { this.faqs = window.LoadFaqs(); return this; } });

TSM.CourseTab = Backbone.Model.extend({
    setServerVariables: function(pageLoadReturn) {
        var tabs = {};
        $.each(pageLoadReturn, function(index, object) {
            tabs[object.tab_name] = object.tab_details;
        });
        tabs["By Providers"] = "";
        return tabs;
    },
    initialize: function() { this.courseTab = this.setServerVariables(window.LoadTabs()); return this; } 
});

TSM.Certifier = Backbone.Model.extend({
    setServerVariables: function(pageLoadReturn) {
        var certifiers = {};
        $.each(pageLoadReturn, function(index, object) {
            certifiers[object.exam_certified_by] = object.certifier_details;
        });
        return certifiers;
    },
    initialize: function() { this.certifiers = this.setServerVariables(window.LoadCertifiers()); return this; }
});

TSM.Course = Backbone.Model.extend({
    alter: function(object) {
        return object.exam_cert + ": " + object.exam_title;
    },
    setServerVariables: function(pageLoadReturn) {
        var courses = [], currentModel = this;
        $.each(pageLoadReturn.appended, function(index, object) {
            var decider = false;
            if (object.exam_title && object.exam_cert) {
                delete pageLoadReturn.appended[index];
                pageLoadReturn.appended[index] = { exam: object.exam, course_title: currentModel.alter(object), exam_certified_by: object.exam_certified_by, tab_name: object.tab_name, tab_level: object.tab_level };
            } else if (!object.exam_title && object.exam_cert) {
                delete pageLoadReturn.appended[index];
                pageLoadReturn.appended[index] = { exam: object.exam, course_title: object.exam_cert, exam_certified_by: object.exam_certified_by, tab_name: object.tab_name, tab_level: object.tab_level };
            }
            for(var i in pageLoadReturn.main) {
                if(pageLoadReturn.main[i].exam == object.exam) {
                    decider = true;
                    courses[index] = { exam: pageLoadReturn.main[i].exam, course_title: pageLoadReturn.main[i].course_title, exam_certified_by: pageLoadReturn.main[i].exam_certified_by, tab_name: object.tab_name, tab_level: object.tab_level };
                    break;
                }
            }
            if(!decider) {
                courses[index] = pageLoadReturn.appended[index];
            }
        });
        delete pageLoadReturn;
        return courses;
    },
    initialize: function() { this.courses = this.setServerVariables(window.LoadCourses()); return this; }
});

TSM.FAQAccordionView = Backbone.View.extend({
    id: "collapsiblecontainer",
    className: "accordion",
    template: JST['contact/faq'],
    initialize: function() {
        for(var index in this.collection) {
            $(this.el).append(this.template({ reference: "#faq-" + index, parentId: "#" + this.id, collapsibleClassName: "collapse", question: this.collection[index].question, bodyId: "faq-" + index, answer: this.collection[index].answer }));
        }
        return this;
    }
});

TSM.CarouselView = Backbone.View.extend({
    className: "carousel slide columns-holder",
    id: "slider",
    initialize: function() {
        var carouselInner = new TSM.DivView({ className: "carousel-inner" }).el, carouselNavigationView = new TSM.DivView({ className: "carousel-navigation" });
        $(this.el).append(carouselInner);
        $(this.el).append(carouselNavigationView.el);
        
        var template = null, variables = null, selector = "", display = "";
        for(var index = 0; index < Math.floor(this.collection.length / 12) + 1; index++) {
            selector = (index == 0) ? 'active ' : '';
            display = (index ==0) ? 'display' : '';
            var UL = (new TSM.TileListView({ collection: this.collection, retrieval: index })).el;
            $(carouselInner).append('<div class="' + selector + 'item"></div>');
            $(carouselInner.children[index]).append(UL);
            variables = { ClassNames: "icon-button " + display, onclick: "$(this.getAttribute('href')).carousel(" + index + ")" }; template = JST['front/carousel-nav'];
            $(carouselNavigationView.el).append(template(variables));
            carouselNavigationView.$(".carousel-nav").click(function(e) {
                e.preventDefault();
                CarouselSlideButton(this);
            });
        }
        // $(this.el).carousel({ pause: "hover", interval: 5000 });
        $(this.el).on("slide", function(e) {
            var selector = ($(this).find(".display")[0].parentNode.parentNode.lastChild == $(this).find(".display")[0].parentNode) ? $(this).find(".display")[0].parentNode.parentNode.firstChild : $(this).find(".display")[0].parentNode.nextSibling;
            CarouselSlideButton(selector);
        });
        return this;
    }
});

TSM.TileListView = Backbone.View.extend({
    tagName: 'ul',
    tileProperties: function(colorArray, model) {
        if (!!model && !model.main_content && !model.short_content && model.image_source) {
            return { model: model, className: "tile" };
        } else {
            return { model: model, className: "tile " + colorArray[Math.round(Math.random()*7)] };
        }
    },
    initialize: function() {
        var until = (this.collection.length > 12 * (this.options.retrieval + 1)) ? 12 : this.collection.length % 12;
        var colorArray = ["aqua", "violet", "orange", "blue", "light-green", "gray", "dark-blue", "yellow"];
        for(var i = 0; i < 12 ; i++) {
            $(this.el).append((new TSM.TileLayoutDecider(this.tileProperties(colorArray, this.collection[ i + 12 * this.options.retrieval ]))).el);
        }
        return this;
    }
});

TSM.TileLayoutDecider = Backbone.View.extend({
    tagName: 'li',
    alterTileImageSource: function(source) {
        return source.replace("public://", TSM.basePath() + "sites/default/files/");
    },
    contentCert: function(course_title) {
        return ("After successfull completion of this couse you will be " + course_title);
    },
    reduceText: function(text, length) {
        return (length < text.length) ? text.slice(0, length) + "..." : text;
    },
    reduceTileHeading: function(model, length) {
        if (!!model.short_content) {
            return this.reduceText(model.short_content, length);
        } else if (!!model.main_content) {
            return this.reduceText(model.main_content, length);
        }
    },
    initialize: function() {
        var layout = null, form = null, newRow = null, newCell = null, caption = null, template = null, formTemplate = null;
        layout = document.createElement('table'); $(layout).addClass("tile-bg");
        $(this.el).click(function() {
            this.children[this.children.length - 1].submit();
        });
        if (!!this.model && !this.model.main_content && !this.model.short_content && this.model.image_source && (newRow = layout.insertRow(layout.rows.length))) {
            caption = '<span class="tile-caption">' + this.model.image_caption + '</span>';
            if (newCell = newRow.insertCell(newRow.cells.length)) {
                var img = document.createElement('img');
                $(img).attr({ 'src': this.alterTileImageSource(this.model.image_source), 'alt': this.model.image_caption, 'title': this.model.image_title, width: '244', height: '120' })
                $(newCell).html(img);
            }
        }
        if(!!this.model && this.model.exam && (formTemplate =  JST['front/course-form']) && (newRow = layout.insertRow(layout.rows.length)) && (newCell = newRow.insertCell(newRow.cells.length))) {
            form = formTemplate({ exam: this.model.exam, course_title: this.model.course_title });
            $(newCell).html((new TSM.HeadingView({ tagName: 'h3', className: "tile-heading", model: this.reduceText(this.model.course_title, 30) })).el);
            if ((newRow = layout.insertRow(layout.rows.length)) && (newCell = newRow.insertCell(newRow.cells.length))) {
                $(newCell).html((new TSM.HeadingView({ tagName: 'p', model: this.reduceText(this.contentCert(this.model.course_title), 135) })).el).addClass("tile-content align-center");
            }
        } else if(!!this.model && this.model.tile_heading && (formTemplate = JST['front/tile-form']) && (this.model.short_content || this.model.main_content) && (newRow = layout.insertRow(layout.rows.length)) && (newCell = newRow.insertCell(newRow.cells.length))) {
            form = formTemplate({ path: "node/" + this.model.node_id });
            $(newCell).html((new TSM.HeadingView({ tagName: 'h3', className: "tile-heading", model: this.reduceText(this.model.tile_heading, 30) })).el);
            if ((newRow = layout.insertRow(layout.rows.length)) && (newCell = newRow.insertCell(newRow.cells.length))) {
                $(newCell).html((new TSM.HeadingView({ tagName: 'p', model: this.reduceTileHeading(this.model, 135) })).el).addClass("tile-content align-center");
            }
        }
        
        $(this.el).html(layout);
        if(caption) { $(this.el).append(caption); }
        if(form) { $(this.el).append(form); }
        
        return this;
    }
});

TSM.CourseTableView = Backbone.View.extend({ tagName: 'table', initialize: function() { return this; } });
TSM.ListView = Backbone.View.extend({ tagName: 'ul', initialize: function() { return this; } });
TSM.ListItemView = Backbone.View.extend({ tagName: 'li', initialize: function() { return this; } });
TSM.DivView = Backbone.View.extend({ initialize: function() { return this; } });
TSM.HeadingView = Backbone.View.extend({ initialize: function() { $(this.el).html(this.model); return this; } });

TSM.SingleCourseView = Backbone.View.extend({
    tagName: 'li',
    initialize: function() {
        var template = null;
        if(template = JST['courses/tab-link']) {
            $(this.el).html(template({ exam: this.model.exam, course_title: this.model.course_title, onclick: "this.parentNode.children[this.parentNode.children.length-1].submit()" }));
        }
        return this;
    }
});

TSM.SingleCourseTableView = Backbone.View.extend({
    tagName: 'tr',
    initialize: function() {
        var template = null;
        if(template = JST['courses/certifier-link-row']) {
            $(this.el).html(template({ exam: this.model.exam, course_title: this.model.course_title, tab_level: this.model.tab_level, onclick: "this.parentNode.children[this.parentNode.children.length-1].submit()" }));
        }
        return this;
    }
});

TSM.ColumnsHolderTabView = Backbone.View.extend({
    initialize: function() {
        $(this.el).html('<p>We are well known for providing high quality and employable courses and offer wide variety of courses which are spanned over various categories like :</p>');
        var cTabListView = new TSM.ListView({ id: "tabslist", className: "nav nav-list" });
        var cTabContentView = new TSM.DivView({ id: "tabscontent", className:"tab-content", initialize: function() { return this; } });
        var tabCount = 0, finder = {}, courseTabPaneView = {}, courseListItemViews = {}, courseListViews = {};
        
        var courseTabPaneZerothView = (new TSM.DivView({ id: "tab-0", className: "tab-pane" }));
        $(cTabContentView.el).html(courseTabPaneZerothView.el);
        $(cTabListView.el).html((new TSM.SingleCourseTabView({ key: 0, model: "By Providers" })).el);
        var certifierTableView = new TSM.CourseTableView({ className: "rows-tab-content" });
        
        for (var index in this.collection.courses) {
            var tempCertifier = this.collection.courses[index].exam_certified_by, tempTab = this.collection.courses[index].tab_name, tempLevel = this.collection.courses[index].tab_level;
            var newRow = null, newCell = null, template = null;
            var courseListItemView = new TSM.SingleCourseView({ model: this.collection.courses[index] });
            var certifierCourseListItem = new TSM.SingleCourseTableView({ model: this.collection.courses[index] });
            if (!finder.hasOwnProperty(tempTab)) {
                tabCount++;
                courseTabPaneView[tempTab] = new TSM.CourseTabPaneView({ id: "tab-" + tabCount, key: tempTab, model: this.collection.tabs[tempTab] });
                $(cTabContentView.el).append((courseTabPaneView[tempTab]).el);
                courseListViews[tempTab] = new TSM.ListView({ className: "list-row courses" });
                $((courseTabPaneView[tempTab]).el).append((courseListViews[tempTab]).el);
                $(cTabListView.el).append((new TSM.SingleCourseTabView({ key: tabCount, model: tempTab })).el);
                finder[tempTab] = tabCount;
            }
            switch (finder.hasOwnProperty(tempCertifier)) {
                case true: $(finder[tempCertifier]).append(certifierCourseListItem.el); break;
                case false:
                courseListViews[tempCertifier] = new TSM.CourseTableView({ className: "rows-tab-content table table-bordered table-striped" });
                newRow = certifierTableView.el.insertRow(certifierTableView.el.rows.length);
                if ((template = JST['courses/certifier']) && (newCell = newRow.insertCell(newRow.cells.length))) {
                    $(newCell).html(template({ certifier: tempCertifier, certifier_details: this.collection.certifiers[tempCertifier] }));
                    $(newCell).append((courseListViews[tempCertifier]).el);
                    
                }
                $((courseListViews[tempCertifier]).el).append(certifierCourseListItem.el);
                finder[tempCertifier] = (courseListViews[tempCertifier]).el; break;
                default: break;
            }
            switch (finder.hasOwnProperty(tempTab + "_" + tempLevel)) {
                case true: $(finder[tempTab + "_" + tempLevel]).append(courseListItemView.el); break;
                case false:
                courseListItemViews[tempTab + "_" + tempLevel] = new TSM.ListItemView();
                $((courseListViews[tempTab]).el).append((courseListItemViews[tempTab + "_" + tempLevel]).el);
                $((courseListItemViews[tempTab + "_" + tempLevel]).el).html(tempLevel);
                courseListViews[tempTab + "_" + tempLevel] = new TSM.ListView({ className: "list-column courses" });
                $((courseListItemViews[tempTab + "_" + tempLevel]).el).append((courseListViews[tempTab + "_" + tempLevel]).el);
                $((courseListViews[tempTab + "_" + tempLevel]).el).append(courseListItemView.el);
                finder[tempTab + "_" + tempLevel] = (courseListViews[tempTab + "_" + tempLevel]).el; break;
                default: break;
            }
        }
        $(courseTabPaneZerothView.el).append(certifierTableView.el)
        $(this.el).append(cTabListView.el);
        $(this.el).append(cTabContentView.el);
        
        return this;
    }
});

TSM.CourseTabPaneView = Backbone.View.extend({
    className: "tab-pane",
    initialize: function() {
        var template = JST['courses/tab-content'];
        $(this.el).html(template({ tab: this.options.key, tab_details: this.model }));
        return this;
    } 
});

TSM.SingleCourseTabView = Backbone.View.extend({
    tagName: 'li',
    initialize: function() {
        var template = null;
        if(template = JST['courses/tab-list']) {
            $(this.el).html(template({ id: "#tab-" + (this.options.key), tab_name: this.model, ClassNames: "icon-chevron-right icon-white" }));
            this.$('[href="#tab-' + this.options.key + '"]').click(function(e) {
                e.preventDefault(); $(this).tab('show');
            }).on('show', function() {
                $(this).find('.icon-chevron-right').show(); $('.icon-chevron-right').not($(this).find('.icon-chevron-right')).hide();
            });
        }
        return this;
    }
});

TSM.Simpledu = Backbone.Router.extend({
    routes: {},
    
    coursesPage: function () {
        var courseTabView = new TSM.ColumnsHolderTabView({ collection: { certifiers: (new TSM.Certifier()).certifiers, courses: (new TSM.Course()).courses, tabs: (new TSM.CourseTab()).courseTab }, className: "columns-holder" });
        $("#coursesweoffer").html(courseTabView.el);
        $('#tabslist a').first().tab('show');
    },
    
    frontPage: function() {
        this.tiles = $.merge((new TSM.Course()).courses, (new TSM.Essential()).essentials);
        var carouselView = new TSM.CarouselView({ collection: _.shuffle(this.tiles) });
        $("#frontpage").html(carouselView.el);
    },
    
    contactPage: function() {
        var faq_collection = (new TSM.FAQ()).faqs;
        var faqAccordionView = new TSM.FAQAccordionView({ collection: faq_collection });
        $(faqAccordionView.el).prepend((new TSM.HeadingView({ tagName: 'h4', className: "column-heading margin gray", model: "Frequently Asked Questions" })).el);
        $("#faqpage").append(faqAccordionView.el);
    },
    
    initialize: function() {
        var location = window.location.pathname.replace(TSM.basePath(), "");
        switch (location) {
            case "": 
            case "node": this.frontPage(); break;
            case "courses-we-offer": this.coursesPage(); break;
            case "contact-us": this.contactPage(); break;
            default: break;
        }
    }
    
});

setRouter();

