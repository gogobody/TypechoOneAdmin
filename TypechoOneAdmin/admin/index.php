<?php
include 'common.php';
include 'header.php';
include 'menu.php';
$url = Helper::options()->pluginUrl . '/TypechoOneAdmin/';
$stat = Typecho_Widget::widget('Widget_Stat');
?>
    <div class="page-header">
        <h3 class="page-title">
<span class="page-title-icon bg-gradient-primary text-white mr-2">
  <i class="mdi mdi-account"></i>
</span>说明文档</h3>
    </div>
    <div class="row" style="margin-bottom: 2em">
        <div class="col-12">
            <div class="card card-img-holder text-black">
                <div class="card-body">
                    <p>插件是基于泽泽社长（qqdie）和 yn-zxj(github) 的purple 后台修改。完全免费开源，插件下载反馈地址：<a href="https://github.com/gogobody/TypechoOneAdmin">github</a></p>
                    <p>提醒：虽然理论上不会对您的文件产生任何影响，但是还是建议您备份 typehco 根目录的admin 目录，以防止typecho版本带来的影响</p>
                    <p>提醒：插件安装完成之后需要刷新缓存生效！！！</p>
                    <p>插件支持登录样式修改以及后台样式修改。</p>
                    <p>欢迎光临我的小站：<a href="https://ijkxs.com">即刻学术</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="page-header">
        <h3 class="page-title">
	<span class="page-title-icon bg-gradient-primary text-white mr-2">
	  <i class="mdi mdi-account"></i>
	</span>博客数据</h3>
    </div>
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="<?php echo $url; ?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">文章总计<i class="mdi mdi-library-books mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><a
                                href="<?php $options->adminUrl('manage-posts.php'); ?>"><?php _e('<em>%s</em> 篇文章', $stat->myPublishedPostsNum); ?></a>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="<?php echo $url; ?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">评论总计<i
                                class="mdi mdi-comment-processing-outline mdi-24px float-right"></i></h4>
                    <h2 class="mb-5"><a
                                href="<?php $options->adminUrl('manage-comments.php'); ?>"><?php _e('<em>%s</em> 条评论', $stat->myPublishedCommentsNum); ?></a>
                    </h2>
                    <h6 class="card-text">
                        <?php if ($user->pass('contributor', true)): ?>
                            <?php if ($user->pass('editor', true) && 'on' == $request->get('__typecho_all_comments') && $stat->waitingCommentsNum > 0): ?>
                                <a style="color:#ffffff;"
                                   href="<?php $options->adminUrl('manage-comments.php?status=waiting'); ?>"><?php _e('待审核的评论'); ?></a>
                                <span class="balloon"><?php $stat->waitingCommentsNum(); ?></span>

                            <?php elseif ($stat->myWaitingCommentsNum > 0): ?>
                                <a style="color:#ffffff;"
                                   href="<?php $options->adminUrl('manage-comments.php?status=waiting'); ?>"><?php _e('待审核评论'); ?></a>
                                <span class="balloon"><?php $stat->myWaitingCommentsNum(); ?></span>

                            <?php endif; ?>
                            <?php if ($user->pass('editor', true) && 'on' == $request->get('__typecho_all_comments') && $stat->spamCommentsNum > 0): ?>
                                <a style="color:#ffffff;"
                                   href="<?php $options->adminUrl('manage-comments.php?status=spam'); ?>"><?php _e('垃圾评论'); ?></a>
                                <span class="balloon"><?php $stat->spamCommentsNum(); ?></span>
                            <?php elseif ($stat->mySpamCommentsNum > 0): ?>
                                <a style="color:#ffffff;"
                                   href="<?php $options->adminUrl('manage-comments.php?status=spam'); ?>"><?php _e('垃圾评论'); ?></a>
                                <span class="balloon"><?php $stat->mySpamCommentsNum(); ?></span>

                            <?php endif; ?>
                        <?php endif; ?>
                    </h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="<?php echo $url; ?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">分类总计<i class="mdi mdi-buffer mdi-24px float-right"></i></h4>
                    <h2 class="mb-5"><a
                                href="<?php $options->adminUrl('manage-categories.php'); ?>"><?php _e('<em>%s</em> 个分类', $stat->categoriesNum); ?></a>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-header">
        <h3 class="page-title">
	<span class="page-title-icon bg-gradient-primary text-white mr-2">
	  <i class="mdi mdi-information-outline"></i>
	</span>相关信息</h3>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?php _e('最近发布的文章'); ?></h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> 日期</th>
                                <th> 文章标题</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize=10')->to($posts); ?>
                            <?php if ($posts->have()): ?>
                                <?php while ($posts->next()): ?>
                                    <tr>
                                        <td><span><?php $posts->date('Y-m-d'); ?></span></td>
                                        <td><a href="<?php $posts->permalink(); ?>"
                                               class="title"><?php $posts->title(); ?></a></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <td><em><?php _e('暂时没有文章'); ?></em></td>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?php _e('最近收到的回复'); ?></h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> 日期</th>
                                <th> 昵称及评论内容</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php Typecho_Widget::widget('Widget_Comments_Recent', 'pageSize=10')->to($comments); ?>
                            <?php if ($comments->have()): ?>
                                <?php while ($comments->next()): ?>
                                    <tr>
                                        <td><span><?php $comments->date('Y-m-d'); ?></span></td>
                                        <td><a href="<?php $comments->permalink(); ?>"
                                               class="title"><?php $comments->author(true); ?></a>:
                                            <?php $comments->excerpt(35, '...'); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <td><em><?php _e('暂时没有回复'); ?></em></td>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include 'copyright.php';
include 'common-js.php';
include 'footer.php';
?>