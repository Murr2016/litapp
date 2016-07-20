FROM tutum/lamp:latest
RUN mkdir repo
RUN rm -fr /app
RUN git clone https://github.com/Murr2016/litapp.git /repo
RUN cp -r /repo/litapp /app
RUN mysql < /app/schema/default.sql
EXPOSE 80
CMD ["/run.sh"]
