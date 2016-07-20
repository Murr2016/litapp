FROM tutum/lamp:latest
ADD resources/my.cnf /etc/mysql/conf.d/my.cnf
RUN mkdir repo
RUN rm -fr /app
RUN git clone https://github.com/Murr2016/litapp.git /repo
RUN cp -r /repo/litapp /app
EXPOSE 80
CMD ["/run.sh"]
